<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoryIdeasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('story_ideas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('creator')->unsigned()->nullable();
            $table->integer('assignee')->unsigned()->nullable();
            $table->string('title', 255);
            $table->string('idea');
            $table->dateTime('deadline')->nullable();
            $table->tinyInteger('is_completed');
            $table->foreign('creator')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('assignee')->references('id')->on('users')->onDelete('SET NULL');
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
        Schema::dropIfExists('story_ideas');
    }
}
