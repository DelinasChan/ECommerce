<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Mail;
use App\Library\Crypto;
use Illuminate\Support\Str;

class MemberController extends Controller
{

    //登入畫面
    public function login(Request $request)
    {
        return view('dashboard.login');
    }

    //登入實作
    public function loginHandler(Request $request)
    {
        $loginPayload = $request->only('account', 'password');
        $loginPayload['is_enabled'] = 1;
        if (Auth('login_user')->attempt($loginPayload)) {
            return redirect()->route('dashboard.index');
        } else {
            $request->session()->flash('error', '帳號或密碼錯誤');
            return redirect()->back()->withInput($request->input);
        };
    }

    //登出
    public function logout()
    {
        Auth::guard('login_user')->logout();
        return redirect()->route('auth.login');
    }

    //註冊畫面
    public function register(Request $request)
    {
        return '登入畫面';
    }

    //實作註冊
    public function registerHandler(Request $request)
    {
        $rules = [
            'account' => 'required|regex:/^[\w]+$/|min:6|max:15|unique:member,account',
            'email' => 'required|email',
            'password' => 'required|regex:/[\w]+/|min:6|max:15',
            'username' => 'required|regex:/^[\w\p{Han}]+$/u|min:2|max:15',
        ];

        $validator = \Validator::make($request->all(), $rules, );
        if ($validator->fails()) {
            $input = $request->input();
            return redirect()->back()->withErrors($validator->errors())->withInput($input);
        }

        $payload = $request->only('account', 'email', 'username', 'password');
        $payload['password'] = \Hash::make($payload['password']);
        $payload['email_token'] = Str::random(10);
        $member = Member::create($payload);

        $data = ['email_token' => $payload['email_token']];
        $token = Crypto::JwtEncode($data, 60000 * 5);
        $mail = (new RegisterMail(['token' => $token, 'member' => $member->id]))->onQueue('email');
        Mail::to($member->email)->queue($mail);

        return redirect()->route('auth.register.view');
    }

    public function validation($userId, Request $request)
    {
        $token = $request->query('token');

        try {
            $email_token = Crypto::JwtDecode($token)['email_token'];
            $member = Member::where('is_enabled', false)->where('id', $userId)
                ->Where('email_token', $email_token)->first();
            $member->email_token = null;
            $member->is_enabled = true;
            $member->save();
            return redirect()->route('auth.login.view');
        } catch (\Exception $e) {
            return abort(404, '此頁面不存在');
        }
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
        $user = Member::where('provider_id', $social_user->id)->first();

        if (!$user) {
            $user = Member::create([
                'provider_token' => $social_user->token,
                'provider_id' => $social_user->id,
                'provider_name' => $provider,
                'email' => $social_user->email,
                'name' => $social_user->name,
                'password' => \Hash::make($social_user->id),
                'is_enabled' => 1,
            ]);
        };

        $credentials = [
            'email' => $user->email,
            'provider_id' => $user->provider_id,
            'password' => $user->provider_id,
        ];

        if (Auth::guard('login_user')->attempt($credentials)) {
            return redirect()->route('dashboard.index');
        } else {
            return redirect()->back();
        };
    }

}
