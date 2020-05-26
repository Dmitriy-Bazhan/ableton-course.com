<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lesson_datas_id')->unsigned();
            $table->text('body')->default('empty');
            $table->integer('good_rang')->default(0);
            $table->integer('bad_rang')->default(0);
            $table->integer('author');  //user id
            $table->timestamps();

            $table->foreign('lesson_datas_id')
                ->references('id')
                ->on('lesson_datas')
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
        Schema::dropIfExists('lesson_comments');
    }
}
