<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Socialite;
use Exception;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SocialController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected $providers = [
        'google'
    ];

    public function redirectToProvider($driver)
    {
        if(!$this->isProviderAllowed($driver) ) {
            return $this->sendFailedResponse("{$driver} is not currently supported");
        }

        try {
            return Socialite::driver($driver)->redirect();
        } catch (Exception $e) {
            // You should show something simple fail message
            return $this->sendFailedResponse($e->getMessage());
        }
    }

    public function handleProviderCallback($driver)
    {
        try {
            $user = Socialite::driver($driver)->user();
        } catch (Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }

        // check for email in returned user
        return empty($user->email)
            ? $this->sendFailedResponse("No email will be returned from {$driver} provider.")
            : $this->loginOrCreateAccount($user, $driver);
    }

    protected function sendFailedResponse($msg = null)
    {
        toastr()->error($msg);

        return redirect()->route('auth.show.login');
    }

    protected function loginOrCreateAccount($providerUser, $driver)
    {
        try {
            // check for already has account
            $user = User::where('email', $providerUser->getEmail())->first();

            // if user already found
            if($user) {
                $user->update([
                    'provider' => $driver,
                    'provider_id' => $providerUser->id,
                    'access_token' => $providerUser->token,
                ]);
            } else {
                // create a new user
                $user = User::create([
                    'name' => $providerUser->getName(),
                    'email' => $providerUser->getEmail(),
                    'provider' => $driver,
                    'provider_id' => $providerUser->getId(),
                    'access_token' => $providerUser->token,
                    'password' => '',
                ]);
                $token = Str::random(30);
                PasswordReset::create([
                    'email'    => $providerUser->getEmail(),
                    'token'    => $token
                ]);

                return redirect()->route('social.show.update-info', ['token' => $token]);
            }

            // login the user
            Auth::login($user, true);

            toastr()->success('Đăng nhập thành công');

            return redirect('/');
        } catch (Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }
    }

    private function isProviderAllowed($driver)
    {
        return in_array($driver, $this->providers) && config()->has("services.{$driver}");
    }

    /**
     * Show update info form
     * 
     * @param string $token
     * @return \Illuminate\Http\Response
     */
    public function showUpdateInfo($token)
    {
        $user = PasswordReset::where('token', '=', $token)->first();
        return view('client.auth.update-info',['email' => $user['email']]);
    }

    /**
     * Update password
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateInfo(Request $request)
    {
        
        if($request->input('password') === $request->input('repassword')){
            User::where('email',$request->input('email'))->update(['password' => bcrypt($request->input('password')), 'phone' => $request->phone]);
            Auth::attempt(['email' => $request->email, 'password' => $request->password], true);
            toastr()->success('Đăng nhập thành công');

            return redirect('/');
        } else{
            toastr()->error('Mật khẩu không trùng khớp');
            return redirect()->back()->withInput();
        }
    }
}
