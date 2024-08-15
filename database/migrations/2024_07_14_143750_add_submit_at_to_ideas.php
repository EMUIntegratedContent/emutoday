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
					$table->dateTime('submitted_at')->nullable()->after('contributor_netid');
					$table->dropColumn('is_submitted');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('insideemu_ideas', function (Blueprint $table) {
            $table->dropColumn('submitted_at');
						$table->tinyInteger('is_submitted')->default(0)->after('contributor_netid');
        });
    }
};
