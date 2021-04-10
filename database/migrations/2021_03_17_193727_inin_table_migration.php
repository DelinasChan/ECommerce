<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IninTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /** 註冊會員即可 上架/購買商品 */
        Schema::create('member', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('用戶姓名');
            $table->string('email')->nullable()->comment('用戶信箱');
            $table->string('login_provider')->nullable()->comment('提供第三方登入組織');
            $table->string('client_token')->nullable()->comment('第三方登入驗證token');
            $table->string('client_id')->nullable()->comment('第三方回傳 id');
            $table->string('account')->nullable()->comment('登入帳號');
            $table->string('password')->nullable()->comment('登入密碼');
            $table->timestamps();
        });

        /** 商品分類 */
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('member_id');
            $table->foreign('member_id')->references('id')->on('member');
        });

        /** 商品 */
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('商品名稱');
            $table->integer('price')->comment('商品價格');
            $table->string('description')->comment('商品描述');
            $table->boolean('is_enable')->default(1)->comment('商品是否啟用');
            $table->unsignedInteger('member_id')->comment('上架用戶Id');
            $table->foreign('member_id')->references('id')->on('member');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
        });

        /** 訂單 */
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->string('pay_status');
            $table->integer('amount')->comment('訂單總金額');

            $table->unsignedInteger('member_id')->comment('用戶');
            $table->foreign('member_id')->references('id')->on('member');

        });

        /** 訂單購買項目*/
        Schema::create('order_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->comment('訂單id');
            $table->string('productName')->comment('商品名稱');
            $table->string('productImage')->comment('商品圖片');
            $table->integer('productPrice')->comment('商品價格');
            $table->integer('amount')->comment('購買數量');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        //order
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_member_id_foreign');
        });

        //products
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_category_id_foreign');
            $table->dropForeign('products_member_id_foreign');
        });

        //
        Schema::dropIfExists('member');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('products');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_item');
    }
}
