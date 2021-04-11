<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModiftMemberTableMigration extends Migration
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
            $table->renameColumn('login_provider', 'provider_name');
            $table->renameColumn('client_token', 'provider_token');
            $table->renameColumn('client_id', 'provider_id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('member', function (Blueprint $table) {
            $table->renameColumn('provider_name', 'login_provider');
            $table->renameColumn('provider_token', 'client_token');
            $table->renameColumn('provider_id', 'client_id');
        });
    }
}
