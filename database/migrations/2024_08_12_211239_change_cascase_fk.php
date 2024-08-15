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
			// Change the foreign key from SET NULL to CASCADE on both idea and post image tables
			Schema::table('insideemu_posts_images', function (Blueprint $table) {
				$table->dropForeign(['insideemu_post_id']);
				$table->foreign('insideemu_post_id')->references('id')->on('insideemu_posts')->onDelete('cascade');
			});

			Schema::table('insideemu_ideas_images', function (Blueprint $table) {
					$table->dropForeign(['insideemu_idea_id']);
					$table->foreign('insideemu_idea_id')->references('id')->on('insideemu_ideas')->onDelete('cascade');
			});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('insideemu_posts_images', function (Blueprint $table) {
            $table->dropForeign(['insideemu_post_id']);
						$table->foreign('insideemu_post_id')->references('id')->on('insideemu_posts')->onDelete('set null');
        });

				Schema::table('insideemu_ideas_images', function (Blueprint $table) {
						$table->dropForeign(['insideemu_idea_id']);
						$table->foreign('insideemu_idea_id')->references('id')->on('insideemu_ideas')->onDelete('set null');
				});
    }
};
