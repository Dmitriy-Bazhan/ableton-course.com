<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lesson_id')->unsigned();
            $table->integer('category_id');
            $table->string('lang', 5);
            $table->string('name');
            $table->string('meta_title', 255)->nullable();
            $table->string('meta_description', 255)->nullable();
            $table->string('meta_keywords', 255)->nullable();
            $table->string('short_description', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('video')->default('empty')->nullable();
            //надо как то субтитры решить
            $table->text('text')->nullable();

            $table->foreign('lesson_id')
                ->references('id')
                ->on('lessons')
                ->onDelete('CASCADE');

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
        Schema::dropIfExists('lesson_datas');
    }
}
