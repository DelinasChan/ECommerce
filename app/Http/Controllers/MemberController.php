<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request ;
use App\Models\MemberModel  ;
use App\Mail\RegisterMail;

use Validator ;
use Mail ;

class User {
    public $name = "Job" ;
}

class MemberController extends Controller
{
    /**
     * 會員註冊
     * @param account   帳號
     * @param password  密碼
     * @param email     信箱
     * @param username  名稱 中英文底線 2到十個字
     */
    public function register( Request $request )
    {   

        //先驗證資料

        /** 驗證資料格式 帳號 密碼 姓名 信箱 */
        $validRules = [
            "email"    => "required|email|unique:member"                  ,
            "account"  => "required|unique:member|regex:/^[\w]{6,}$/"     ,
            "username" => "required|min:3|regex:/^[\p{Han}A-Za-z_\-]+$/u" ,
            "password" => "required|regex:/^[\w]{6,}$/"                 
        ];

        $validator = Validator::make( $request->all() , $validRules ) ;
        /** 資料驗證 */
        if ( $validator->fails()) {
            return response()->json( [
                'message' => '欄位錯誤訊息如下' , 
                'errors'  => $validator->messages()
            ] , 400 ) ;
        };

        //寄信
        $recipient = $request->input("email") ;
        Mail::to( $recipient )->queue(new RegisterMail( [] )) ;
        MemberModel::create($request->all());
        return response()->json([
            "expected" => "" ,
            "data" => MemberModel::all()
        ]);

    }
}
