<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyTabelMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('member', function (Blueprint $table) {
            $table->renameColumn('name', 'username');
            $table->string('email_token')->nullable()->comment('信箱驗證碼');
            $table->boolean('is_enabled')->default(false)->comment('有重新申請帳號 設為停用');
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
        Schema::table('member', function (Blueprint $table) {
            $table->renameColumn('username', 'name');
            $table->dropColumn('email_token');
            $table->dropColumn('is_enabled');
        });
    }
}
