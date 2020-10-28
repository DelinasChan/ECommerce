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
            $table->string('description'); //產品描述
            $table->string('photo'); //產品圖片
            $table->string('price')->nullable(false) ; //產品單價
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
            $table->string("id"); //訂單編號 十二位中英文流水號
            $table->string("memberId")->index()->nullable(false) ; //會員Id
            // WAIT(尚未付款) SUCCESS(付款成功) FAILED(付款失敗)
            $table->enum( "payStatus" , ["WAIT","SUCCESS","FAILED"])->default("WAIT") ;
            $table->integer("amount") ; //總金額
            $table->timestamps();
        });

        /** 訂單列表 */
        Schema::create('orderItem', function (Blueprint $table) {
            $table->increments("id");
            $table->string("orderId")->index()->nullable(false)   ; //訂單編號
            $table->string("productId")->index()->nullable(false) ; //該訂單對應產品
            $table->integer("price") ; //購買時單價
            $table->integer("quant") ; //購買時數量
            $table->timestamps();
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
