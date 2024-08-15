<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
	/**
	 * Run the migrations.
	 */
	public function up(): void{
		Schema::table('insideemu_posts', function (Blueprint $table){
			$table->dropColumn('submitted_by');
			$table->string('source')->after('end_date');
		});

		Schema::table('insideemu_posts', function (Blueprint $table){
			// Add foreign key to insideemu_ideas table
			$table->unsignedInteger('created_by')->nullable()->after('end_date');
			$table->foreign('created_by')->references('id')->on('users')->onDelete('SET NULL');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void{
		Schema::table('insideemu_posts', function (Blueprint $table){
			$table->dropColumn('source');
			$table->string('submitted_by')->after('end_date');
		});

		Schema::table('insideemu_posts', function (Blueprint $table){
			$table->dropForeign(['created_by']);
		});
	}
};
