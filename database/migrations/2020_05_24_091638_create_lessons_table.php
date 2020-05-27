<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alias');
            $table->integer('category_id')->default(0);
            $table->string('tags')->default('');
            $table->boolean('enabled')->default(true);
            $table->integer('good_rang')->default(0);
            $table->integer('bad_rang')->default(0);
            $table->integer('views')->default(0);
            $table->string('image_big');
            $table->string('image_small');
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
        Schema::dropIfExists('lessons');
    }
}
