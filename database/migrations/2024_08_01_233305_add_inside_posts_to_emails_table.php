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
			$table->tinyInteger('exclude_inside_posts')->default(0)->after('exclude_events');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('emails', function (Blueprint $table) {
			$table->dropColumn(['exclude_inside_posts']);
		});
	}
};
