<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('emails', function (Blueprint $table) {
					$table->tinyInteger('is_emu175_included');
					$table->text('emu175_teaser')->nullable();
					$table->text('emu175_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('emails', function (Blueprint $table) {
					$table->dropColumn(['is_emu175_included', 'emu175_teaser', 'emu175_url']);
        });
    }
};
