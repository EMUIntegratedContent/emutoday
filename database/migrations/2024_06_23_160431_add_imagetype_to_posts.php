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
        Schema::table('intcomm_posts_images', function (Blueprint $table) {
					// Add foreign key to imagetype_id
					$table->unsignedInteger('imagetype_id')->nullable(); // imagetypes table doesn't use bigInteger, so just use integer
					$table->foreign('imagetype_id')->references('id')->on('imagetypes')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('intcomm_posts_images', function (Blueprint $table) {
            $table->dropForeign(['imagetype_id']);
						$table->dropColumn('imagetype_id');
        });
    }
};
