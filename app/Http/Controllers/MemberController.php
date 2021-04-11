<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Mail;

class MemberController extends Controller
{

    //
    public function login()
    {

        return view('dashboard.login');
    }

    public function logout()
    {
        Auth::guard('loginUser')->logout();
        return redirect()->route('auth.login');
    }

    public function register(Request $request)
    {

        $rules = [
            'account' => 'required|regex:/[\w]+/|min:6|max:15|unique:member,account',
            'email' => 'required|regex:/[\w]+/|min:6|max:15|unique:member,email',
            'password' => 'required|regex:/[\w]+/|min:6|max:15',
            'name' => 'required|regex:/[\w\u4e00-\u9fa5]+/|min:2|max:15',
        ];
        $validator = \Validator::make($request->all(), $rules);

        dd($validator->errors());
        $mail = (new RegisterMail(['token' => 'vasdasdsaddas']))->onQueue('emails');
        Mail::to('danti4811@gmail.com')->queue($mail);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        return '註冊';
    }

    public function validation(Request $request)
    {
        dd($request->all());
    }

    //社交媒體登入
    public function social_login($social_provider, Request $request)
    {
        if (!config("services.$social_provider")) {
            abort('404');
        };
        $request->session()->put('social_provider', $social_provider);
        return Socialite::driver($social_provider)->redirect();
    }

    public function social_login_callback(Request $request)
    {

        $provider = $request->session()->get('social_provider');
        $social_user = Socialite::driver($provider)->user();
        //名子可能會改
        $user = Member::where('provider_id', $social_user->id)->first();
        if (!$user) {
            $user = Member::create([
                'provider_token' => $social_user->token,
                'provider_id' => $social_user->id,
                'provider_name' => $provider,
                'email' => $social_user->email,
                'name' => $social_user->name,
                'password' => \Hash::make($social_user->id),
            ]);
        };

        $credentials = [
            'email' => $user->email,
            'provider_id' => $user->provider_id,
            'password' => $user->provider_id,
        ];

        if (Auth::guard('loginUser')->attempt($credentials)) {
            return redirect('dashboard');
        } else {
            return redirect()->back();
        };
    }

}
