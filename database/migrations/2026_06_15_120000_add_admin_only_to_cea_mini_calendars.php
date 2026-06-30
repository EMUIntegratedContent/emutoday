<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminOnlyToCeaMiniCalendars extends Migration
{
    public function up()
    {
        Schema::table('cea_mini_calendars', function (Blueprint $table) {
            $table->boolean('admin_only')->default(false)->after('parent');
        });
    }

    public function down()
    {
        Schema::table('cea_mini_calendars', function (Blueprint $table) {
            $table->dropColumn('admin_only');
        });
    }
}
