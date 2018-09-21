<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailStoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_story', function (Blueprint $table) {
          $table->integer('email_id')->unsigned()->index();
          $table->integer('story_id')->unsigned()->index();
          $table->integer('order');
          $table->foreign('email_id')->references('id')->on('emails')->onDelete('cascade');
          $table->foreign('story_id')->references('id')->on('storys')->onDelete('cascade');
          $table->timestamps();

          $table->primary(['email_id', 'story_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_story');
    }
}
