<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailinglistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailinglists', function (Blueprint $table) {
          $table->increments('id');
          $table->string('email_address')->unique();
          $table->string('description');
          $table->timestamps();
        });

        Schema::create('email_recipients', function (Blueprint $table) {
          $table->integer('email_id')->unsigned()->index();
          $table->integer('mailinglist_id')->unsigned()->index();
          $table->foreign('email_id')->references('id')->on('emails')->onDelete('cascade');
          $table->foreign('mailinglist_id')->references('id')->on('mailinglists')->onDelete('cascade');
          $table->timestamps();

          $table->primary(['email_id', 'mailinglist_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_recipients');
        Schema::dropIfExists('mailinglists');
    }
}
