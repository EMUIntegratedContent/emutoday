<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
	/**
	 * Run the migrations.
	 */
	public function up(): void{
		Schema::create('intcomm_ideas_images', function (Blueprint $table){
			$table->id();
			$table->unsignedBigInteger('intcomm_idea_id')->nullable();
			$table->foreign('intcomm_idea_id')->references('id')->on('intcomm_ideas')->onDelete('SET NULL');
			$table->string('image_name', 255);
			$table->string('image_path', 255);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void{
		Schema::dropIfExists('intcomm_ideas_images');
	}
};
