<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpertsExpertcategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experts_expertcategory', function (Blueprint $table) {
            $table->integer('expert_id')->unsigned();
            $table->integer('cat_id')->unsigned();

            $table->foreign('expert_id')->references('id')->on('experts')->onDelete('cascade');
            $table->foreign('cat_id')->references('id')->on('expertscategory')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('experts_expertcategory', function (Blueprint $table) {
            Schema::drop('experts_expertcategory');
        });
    }
}
