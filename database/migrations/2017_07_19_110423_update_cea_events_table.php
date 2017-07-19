<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCeaEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cea_events', function (Blueprint $table) {
            /* Capture the ID of the event in its external table.*/
            $table->integer('external_record_id')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cea_events', function (Blueprint $table) {
            $table->dropColumn(['external_record_id']);
        });
    }
}
