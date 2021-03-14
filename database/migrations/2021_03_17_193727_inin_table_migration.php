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
        //
        Schema::create('store',function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
        });


        Schema::create('category',function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('store_id');
            $table->foreign('store_id')->references('id')->on('store');
        });

        Schema::create('products',function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('store_id');
            $table->foreign('store_id')->references('id')->on('store');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('category');
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
