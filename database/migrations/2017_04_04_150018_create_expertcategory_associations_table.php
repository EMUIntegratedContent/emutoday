<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpertcategoryAssociationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expertcategory_associations', function (Blueprint $table) {

              $table->integer('cat_id')->unsigned();
              $table->integer('assoc_id')->unsigned();

              $table->foreign('cat_id')->references('id')->on('expertscategory')->onDelete('cascade');
              $table->foreign('assoc_id')->references('id')->on('expertscategory')->onDelete('cascade');

              // Ensures this relationship occurs only once
              $table->primary(array('cat_id', 'assoc_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expertcategory_associations', function (Blueprint $table) {
            Schema::drop('expertcategory_associations');
        });
    }
}
