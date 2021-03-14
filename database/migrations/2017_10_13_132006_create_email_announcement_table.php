<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailAnnouncementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_announcement', function (Blueprint $table) {
          $table->integer('email_id')->unsigned()->index();
          $table->integer('announcement_id')->unsigned()->index();
          $table->integer('order');
          $table->foreign('email_id')->references('id')->on('emails')->onDelete('cascade');
          $table->foreign('announcement_id')->references('id')->on('announcements')->onDelete('cascade');
          $table->timestamps();

          $table->primary(['email_id', 'announcement_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_announcement');
    }
}
