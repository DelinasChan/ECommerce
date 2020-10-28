<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request ;
use App\Models\MemberModel  ;
use App\Mail\RegisterMail;
use App\Library\Crypto ;

use Validator ;
use Mail ;

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

        /** 產生JWT token 做 信箱認證 10分鐘 600 */
        $mailData = [ 'mail_token' =>  Crypto::JwtEncode( [] , 600  ) ] ;
        $insertData = $request->all() ;
        $recipient = $request->input("email")   ;
        $password = $request->input("password") ;
        $insertData["password"] = Crypto::hash( $password );
        $insertData["mail_token"] = $mailData["mail_token"] ; //會員變更資料 驗證信箱 token

        /** 新增會員 */
        $NewMember = MemberModel::create($insertData);
        /** 根據新建會員Id 寄信 */
        $mailData["memberId"]   = $NewMember->id ; 
        $mailData["host"] = $request->getHttpHost();

        //寄信
        Mail::to( $recipient )->queue(new RegisterMail( $mailData )) ;
        return response()->json([ "host" => $request->getHttpHost()  , "data" => $data ]);

    }

    /** 信箱認證 */
    public function verifyMail( Request $request ){ 
        
        $jwtToken = $request->query("token") ;
        $memberId = $request->memberId  ;
        $data = Crypto::JwtDecode( $jwtToken ) ; //驗證Token 失敗代表逾期

        if( isset($data["error"]) ){
            // Token過期 刪除相關資料 重新註冊
            MemberModel::destroy($memberId);
            return [ "error" => "申請 已逾期 請重新註冊帳號" ] ;
        };

        $member = (new MemberModel())->where( ["id" => $memberId ] )->whereIn("mail_token", [$jwtToken,"SUCCESS"] )>first();
        //查無此資料 刪除所有資料 重新註冊
        if( ! isset( $member ) ){
            MemberModel::destroy($memberId);
            return [ "error" => "申請異常 請重新申請 " ] ;
        };
        
        //信箱驗證成功 更新 mail_token = SUCCESS
        $member->mail_token = 'SUCCESS';
        $member->save();
        return "申請成功" ;
        
    }

}
