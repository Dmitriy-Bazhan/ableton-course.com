<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->json('important_topic')->nullable();
            $table->json('important_lessons')->nullable();
            $table->json('important_links')->nullable();
            $table->json('push_like')->nullable();         //id лайкнутых уроков
            $table->json('push_dislike')->nullable();       //id дизлайкнутых уроков
            $table->json('favorites')->nullable();          //id уроков добавленых в избраное
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_data');
    }
}
