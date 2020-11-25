<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request ;
use App\Models\MemberModel  ;
use App\Mail\RegisterMail;
use App\Library\Crypto ;

use Socialite;
use Validator ;
use Mail ;

class MemberController extends Controller
{   

    /** fb登入 */

    public function fbLogin( Request $request )
    {   
        $redirectUrl = env("FB_REDIRECT");
        return Socialite::driver('facebook')->redirectUrl($redirectUrl)->redirect();
    }

    public function fbCallBack( Request $request )
    {   
        try{

            $user = Socialite::driver('facebook')->user();
            $user->facebook_id = $user->getId();
            $ap = "FACEBOOK"  . time()  ; //帳號密碼 FACEBOOK + 時間戳記
            $CreateData = [
                "fb_id" => $user->getId()    ,
                "username"  => $user->getName()  ,
                "email" => $user->getEmail() ,
                "photo" => $user->getAvatar(), // 照片等於網址
                "account" => $ap , "password" =>  $ap ,
                "mail_token" => "SUCCESS"
            ];
            //不做信箱驗證( 臉書驗證過 )
            $Member = MemberModel::Create( $CreateData );
            return redirect("/") ;
        }catch( Exception $e ){
            return redirect("/") ;
        }


        // return Socialite::driver('facebook')->redirectUrl($redirectUrl)->redirect();
    }


    /**
     * 會員登入
     * @param account  帳號 ( 可以是信箱 )
     * @param password 密碼
     */
    public function login ( Request $request )
    {   

        $body = $request->all() ;

        $account = $body["account"];
        $password = $body["password"] ;
        /** 密碼 以 MD5 加密後比對 */
        $paramter = [ $account , $account , Crypto::hash( $password ) ] ;
        $Member = MemberModel::whereRaw(" ( account = ? OR email = ? ) AND password = ? AND mail_token = 'SUCCESS' " , $paramter )->first();
        if( !isset( $Member ) ){
            return response()->json(["status" => false , "message" => "登入失敗 帳號或密碼錯誤 ... " ]) ;
        }else{
            return response()->json(["status" => true  , "message" => "成功" ]) ;
        };
    }

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
            "password" => "required|regex:/^[\w]{6,}$/"                   ,
            "validCode"  => "required|captcha"
        ];
        
        $validator = Validator::make( $request->all() , $validRules ) ;

        /** 資料驗證 */
        if ( $validator->fails()) {
            return response()->json( [
                'message' => '欄位有錯訊息如下' , 
                'errors'  => $validator->messages()
            ] , 200 ) ;
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
        return response()->json([ "host" => $request->getHttpHost()  , "status" => true , "message" => "註冊成功" ]);

    }

    /** 信箱認證 */
    public function verifyMail( Request $request ){ 
        
        $jwtToken = $request->query("token") ;
        $memberId = $request->memberId  ;
        $data = Crypto::JwtDecode( $jwtToken ) ; //驗證Token 失敗代表逾期

        if( isset($data["error"]) ){
            // Token過期 刪除相關資料 重新註冊
            MemberModel::destroy($memberId);
            return view("emails.result")->with(["status"=> false , "message" => "驗證碼逾時，請重新註冊"  , "type" => "DELAY"  ]) ;
        };

        $member = (new MemberModel())->where( ["id" => $memberId ] )->whereIn("mail_token", [$jwtToken,"SUCCESS"] )->first();
        //查無此資料 刪除所有資料 重新註冊
        if( ! isset( $member ) ){
            MemberModel::destroy($memberId);
            return view("emails.result")->with(["status"=> false , "message" => "發生異常 請重新申請!" , "type" => "UNKNOWN"]) ;
        }else if( $member->mail_token == "SUCCESS" ){
            //帳號已經驗證過
            return view("emails.result")->with(["status"=>true , "message"=>"帳號重複驗證"]) ;
        };
        
        //信箱驗證成功 更新 mail_token = SUCCESS
        $member->mail_token = 'SUCCESS';
        $member->save();
        return view("emails.result")->with(["status"=>true , "message"=>"申請成功 畫面將自動跳轉"]) ;
        
    }

}
