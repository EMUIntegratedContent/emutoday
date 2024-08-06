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
				$table->renameColumn('contributor', 'contributor_netid');
			});

			Schema::table('insideemu_ideas', function (Blueprint $table) {
				$table->string('contributor_first', 40)->nullable();
				$table->string('contributor_last', 40)->nullable();
			});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
			Schema::table('insideemu_ideas', function (Blueprint $table) {
				$table->renameColumn('contributor_netid', 'contributor');
			});

			Schema::table('insideemu_ideas', function (Blueprint $table) {
				$table->dropColumn('contributor_first');
				$table->dropColumn('contributor_last');
			});
    }
};
