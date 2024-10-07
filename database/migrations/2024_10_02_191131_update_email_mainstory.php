<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
	/**
	 * Run the migrations.
	 */
	public function up(): void{
		Schema::table('email_mainstory', function (Blueprint $table){
			// Add insideemu_post_id column as a nullable foreign key
			$table->unsignedBigInteger('insideemu_post_id')->unsigned()->nullable()->after('story_id')->index();
			$table->foreign('insideemu_post_id')->references('id')->on('insideemu_posts')->onDelete('cascade');

			// Drop the existing primary key
			$table->dropPrimary(['email_id', 'story_id']);

			// Add new composite primary key
			$table->primary(['email_id', 'order']);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void{
		Schema::table('email_mainstory', function (Blueprint $table){
			$table->dropForeign(['insideemu_post_id']);
			$table->dropColumn('insideemu_post_id');

			// Drop the existing primary key
			$table->dropPrimary(['email_id', 'order']);

			// Add new composite primary key
			$table->primary(['email_id', 'story_id']);
		});
	}
};
