<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table){
           $table->increments('id');
           $table->string('subject', 256);
           $table->text('content');
           $table->dateTime('start_date');
           $table->dateTime('expiration_date');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
           $table->timestamps();
           $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
