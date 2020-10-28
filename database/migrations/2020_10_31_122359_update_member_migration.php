<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMemberMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('member', function (Blueprint $table){
            $table->longText( 'mail_token' , 255 )->default("ENABLE")->after("password");
            //FB登入 id
            $table->longText( 'fb_id' , 50 )->after("mail_token");
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
