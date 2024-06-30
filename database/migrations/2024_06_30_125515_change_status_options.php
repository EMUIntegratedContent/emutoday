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
			Schema::table('intcomm_posts', function (Blueprint $table) {
				$table->dropColumn('status');
			});

			Schema::table('intcomm_posts', function (Blueprint $table) {
				$table->enum('admin_status', ['Pending', 'Approved', 'Denied'])->default('Pending');
			});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
			Schema::table('intcomm_posts', function (Blueprint $table) {
				$table->dropColumn('admin_status');
			});

			Schema::table('intcomm_posts', function (Blueprint $table) {
				$table->enum('status', ['Pending', 'Approved', 'Denied'])->default('Pending');
			});
    }
};
