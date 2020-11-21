<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        /** 建立多媒體資料 */
        Schema::create('media', function (Blueprint $table) {
            $table->increments("id");
            $table->string('name'); //圖片名稱
            $table->string('alt')->nullable(true) ; //替代文字
            $table->string('src') ; //圖片網址
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
        Schema::dropIfExists('media_migration');
    }
}
