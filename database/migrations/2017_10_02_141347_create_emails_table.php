<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('subheading')->nullable();
            $table->tinyInteger('is_approved');
            $table->tinyInteger('is_ready');
            //$table->integer('mainstory_id')->unsigned()->nullable();
            $table->integer('clone_email_id')->unsigned()->nullable(); // if this email is cloned, mark from which one
            $table->dateTime('send_at')->nullable();
            $table->tinyInteger('is_sent');
            $table->integer('mailgun_opens'); // to be incremented by Mailgun Webhooks
            $table->integer('mailgun_clicks'); // to be incremented by Mailgun Webhooks
            $table->integer('mailgun_spam'); // to be incremented by Mailgun Webhooks
            $table->softDeletes();
            //$table->foreign('mainstory_id')
              //->references('id')->on('storys')
              //->onDelete('cascade');
            $table->foreign('clone_email_id')
              ->references('id')->on('emails')
              ->onDelete('set null');
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
        Schema::dropIfExists('emails');
    }
}
