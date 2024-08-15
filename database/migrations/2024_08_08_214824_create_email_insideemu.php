<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

	/**
	 * Run the migrations.
	 */
	public function up(): void{
		Schema::create('email_insideemu', function (Blueprint $table){
			$table->unsignedInteger('email_id')->index();
			$table->unsignedBigInteger('insideemu_post_id')->index();
			$table->integer('order');
			$table->timestamps();
			$table->primary(['email_id', 'insideemu_post_id']);
		});

		Schema::table('email_insideemu', function (Blueprint $table){
			$table->foreign('email_id')->references('id')->on('emails')->onDelete('cascade');
			$table->foreign('insideemu_post_id')->references('id')->on('insideemu_posts')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void{
		Schema::dropIfExists('email_insideemu');
	}
};
