<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoryIdeaMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storyidea_mediums', function (Blueprint $table) {
            $table->increments('id');
            $table->string('medium')->unique();
            $table->timestamps();
        });

        Schema::table('story_ideas', function (Blueprint $table) {
            $table->integer('medium')->unsigned()->nullable();
            $table->foreign('medium')->references('id')->on('storyidea_mediums')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('story_ideas', function (Blueprint $table) {
            $table->dropColumn('storyidea_mediums');
        });
        Schema::dropIfExists('storyidea_mediums');
    }
}
