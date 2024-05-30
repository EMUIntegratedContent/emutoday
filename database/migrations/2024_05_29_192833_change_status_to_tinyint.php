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
			  Schema::table('intcomm_ideas', function (Blueprint $table) {
					$table->dropColumn('status');
					$table->renameColumn('submitted_by', 'contributor');
				});

        Schema::table('intcomm_ideas', function (Blueprint $table) {
					$table->tinyInteger('is_submitted')->default(0);
					$table->enum('admin_status', ['New', 'Viewed', 'Not Considering', 'Considering', 'Done'])->default('New');
				});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
				Schema::table('intcomm_ideas', function (Blueprint $table) {
					$table->dropColumn('admin_status');
					$table->renameColumn('contributor', 'submitted_by');
				});

        Schema::table('intcomm_ideas', function (Blueprint $table) {
					$table->dropColumn('is_submitted');
					$table->enum('status', ['Draft', 'Submitted'])->default('Draft');
        });
    }
};
