<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpertsImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experts_images', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('expert_id')->unsigned();
            $table->boolean('is_active');
            $table->integer('imagetype_id')->unsigned()->nullable();
            $table->string('title');
            $table->string('caption')->nullable();
            $table->string('image_extension', 10);
            $table->string('filename');
            $table->string('image_path');
            $table->string('group');

            $table->foreign('expert_id')->references('id')->on('experts')->onDelete('cascade');
            $table->foreign('imagetype_id')->references('id')->on('imagetypes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('experts_images', function (Blueprint $table) {
            Schema::drop('experts_images');
        });
    }
}
