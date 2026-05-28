<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSidearmPermalinkToCeaEvents extends Migration
{
    public function up()
    {
        Schema::table('cea_events', function (Blueprint $table) {
            $table->string('sidearm_permalink', 500)->nullable()->after('external_record_id');
        });
    }

    public function down()
    {
        Schema::table('cea_events', function (Blueprint $table) {
            $table->dropColumn('sidearm_permalink');
        });
    }
}
