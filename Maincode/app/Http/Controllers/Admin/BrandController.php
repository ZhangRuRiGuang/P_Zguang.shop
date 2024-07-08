<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::where('shop_id', Shop::where('admin_id', Auth::guard('admin')->user()->id)->first()->id)->get();
        return view('admin.brands.list',['brands'=>$brands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            //  Let's do everything here
            if ($request->file('image')->isValid()) {
                //
                $validated = $request->validate([
                    'brand-name' => 'required'
                ]);
                $request->image->storeAs('/public/images/brands', $request->image->getClientOriginalName());
                Brand::create([
                   'name' => $validated['brand-name'],
                   'image' => '/storage/images/brands/' . $request->image->getClientOriginalName(),
                   'shop_id' => Shop::where('admin_id', Auth::guard('admin')->user()->id)->first()->id
                ]);
                toastr()->success('Thêm thành công');
                return redirect()->route('brand.list');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brands.edit',['brand' => $brand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $brand = Brand::find($id);
        if ($request->hasFile('image')) {
            //  Let's do everything here
            if ($request->file('image')->isValid()) {
                $request->image->storeAs('/public/images/brands', $request->image->getClientOriginalName());
                $brand->image = '/storage/images/brands/' . $request->image->getClientOriginalName();
            }
        }
        $brand->name = $request->input('brand-name');
        $brand->save();
        toastr()->success('Cập nhật thành công');
        return redirect()->route('brand.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        $brand->delete();
        toastr()->success('Xóa thành công');
        return redirect()->route('brand.list');
    }

    public function updateStatus($id, $status)
    {
        $product = Brand::find($id);
        $product->status = $status;
        $product->save();
        toastr()->success('Cập nhật trạng thái thành công');
        return redirect()->route('brand.list');
    }
}