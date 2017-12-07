<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaHighlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_highlights', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('added_by')->unsigned()->nullable();
            $table->string('title', 100);
            $table->string('url');
            $table->string('source');
            $table->dateTime('start_date');
            $table->integer('priority');
            $table->tinyInteger('is_archived');
            $table->foreign('added_by')->references('id')->on('users')->onDelete('SET NULL');
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
        Schema::dropIfExists('media_highlights');
    }
}
