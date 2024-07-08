<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
     /**
     * Show the user form login
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Show the user form register
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegisterForm()
    {
        return view('admin.register');
    }

    /**
     * Handle login
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {
            $result = Auth::guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], true);
            if ($result) {
                if (Auth::guard('admin')->user()->role == 0) {
                    return redirect()->route('shop.list');
                } elseif (Auth::guard('admin')->user()->role == 1) {
                    if (Shop::where('admin_id', Auth::guard('admin')->user()->id)->first()->status == 1) {
                        return redirect()->route('dashboard');
                    } else {
                        return redirect()->back()->with('invalid', 'Hiện tại cửa hàng của bạn đang tạm khóa, vui lòng liên hệ quản trị viên để được hỗ trợ')->withInput();
                    }
                } else {
                    return redirect()->route('rating.list');
                }
            } else {
                $validator = \Validator::make([], []);
                $validator->errors()->add('email', 'Email/Mật khẩu không đúng');

                return redirect()->back()->withErrors($validator)->withInput();
            }
        } catch (\Throwable $e) {
            \Log::info($e->getMessage());
        }
    }

    public function register(Request $request)
    {
        $checkEmailExist = Admin::where('email', $request->email)->exists();
        if ($checkEmailExist) {
            $validator = \Validator::make([], []);
            $validator->errors()->add('email', 'Email đã tồn tại');

            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $request->image->storeAs('/public/images/shops', $request->image->getClientOriginalName());
                $admin = Admin::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password)
                ]);
        
                Shop::create([
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'name' => $request->shop,
                    'description' => $request->des,
                    'admin_id' => $admin->id,
                    'image' => '/storage/images/shops/' . $request->image->getClientOriginalName(),
                ]);

                Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], true);
                if (Auth::guard('admin')->user()->role == 0) {
                    return redirect()->route('shop.list');
                } elseif (Auth::guard('admin')->user()->role == 1) {
                    return redirect()->route('dashboard');
                } else {
                    return redirect()->route('rating.list');
                }
            }
        }
        
    }

    /**
     * Logout
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.form.login');
    }
}
