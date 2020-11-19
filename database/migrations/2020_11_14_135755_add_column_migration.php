<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //order 資料表 新增綠界交易編號 TradeNo
        Schema::table('order', function (Blueprint $table){
            $table->string( 'ecPay_tradeNo' , 50 )->after("payStatus");
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
