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
        Schema::table('insideemu_ideas', function (Blueprint $table) {
					$table->tinyInteger('use_other_source')->default(0)->after('contributor_last');
					$table->string('other_source')->nullable()->after('contributor_last');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('insideemu_ideas', function (Blueprint $table) {
          $table->dropColumn('use_other_source');
					$table->dropColumn('other_source');
        });
    }
};
