<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediahighlightsTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mediahighlights_tags', function (Blueprint $table) {
          $table->integer('mediahighlight_id')->unsigned()->index();
          $table->integer('tag_id')->unsigned()->index();
          $table->foreign('mediahighlight_id')->references('id')->on('media_highlights')->onDelete('cascade');
          $table->foreign('tag_id')->references('id')->on('media_highlight_tags')->onDelete('cascade');
          $table->timestamps();

          $table->primary(['mediahighlight_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mediahighlights_tags');
    }
}
