<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('ISBN')->unique();
            $table->integer('year');
            $table->string('description', 1000);
            $table->string('coverImage')->nullable();
            $table->integer('user_id')->unsigned();
            
        });

        Schema::table('books', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
     
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
