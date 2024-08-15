<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
	/**
	 * Run the migrations.
	 */
	public function up(): void{
		Schema::create('insideemu_posts_images', function (Blueprint $table){
			$table->id();
			$table->unsignedBigInteger('insideemu_post_id')->nullable();
			$table->foreign('insideemu_post_id')->references('id')->on('insideemu_posts')->onDelete('SET NULL');
			$table->boolean('is_active')->default(1);
			$table->string('image_name', 255);
			$table->string('image_path', 255);
			$table->string('title', 255)->nullable();
			$table->string('caption', 255)->nullable();
			$table->string('teaser', 255)->nullable();
			$table->string('moretext', 255)->nullable();
			$table->string('alt_text', 255)->nullable();
			$table->string('link', 255)->nullable();
			$table->string('link_text', 255)->nullable();
			$table->string('image_extension', 10);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void{
		Schema::dropIfExists('insideemu_posts_images');
	}
};
