<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailEventTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_event', function (Blueprint $table) {
          $table->integer('email_id')->unsigned()->index();
          $table->integer('event_id')->unsigned()->index();
          $table->integer('order');
          $table->foreign('email_id')->references('id')->on('emails')->onDelete('cascade');
          $table->foreign('event_id')->references('id')->on('cea_events')->onDelete('cascade');
          $table->timestamps();

          $table->primary(['email_id', 'event_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_event');
    }
}
