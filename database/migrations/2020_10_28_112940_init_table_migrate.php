<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitTableMigrate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /** 產品資料表 */
        Schema::create('product', function (Blueprint $table) {
            $table->increments("id");
            $table->string('name'); //產品名稱
            $table->longText('introduce'); //產品描述
            $table->longText('attachments'); //產品圖片
            $table->string('discountPrice')->default(0) ; //售價
            $table->string('originalPrice')->default(0) ; //原價
            $table->timestamps();
        });

        /** 會員資料表 */
        Schema::create('member', function (Blueprint $table) {
            $table->increments("id");
            $table->string('name'); //會員名稱
            $table->string('account'); //帳號
            $table->string('email')->unique() ; //會員信箱
            $table->string('password')->unique() ; //密碼
            $table->string('introduction'); //自我介紹
            $table->string('photo'); //會員照片
            $table->timestamps();
        });

        /** 訂單(可以為登入時購買) */
        Schema::create('order', function (Blueprint $table) {
            $table->unsignedInteger("id")->primary(); ; //訂單編號 十二位中英文流水號
            $table->unsignedInteger('memberId');
            $table->foreign("memberId")->references("id")->on('member')    ; //訂單編號
            // WAIT(尚未付款) SUCCESS(付款成功) FAILED(付款失敗)
            $table->enum( "payStatus" , ["WAIT","SUCCESS","FAILED"])->default("WAIT") ;
            $table->integer("amount") ; //總金額
            $table->timestamps();
        });

        /** 訂單列表 */
        Schema::create('orderItem', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("orderId")   ;
            $table->unsignedInteger("productId") ;
            $table->integer("price") ; //購買時單價
            $table->integer("quant") ; //購買時數量
            $table->timestamps();

            /** 設定外來建 */
            $table->foreign("orderId")->references("id")->on('order')    ; //訂單編號
            $table->foreign("productId")->references("id")->on('product'); //該訂單對應產品


        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
