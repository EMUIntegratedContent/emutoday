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
        Schema::table('insideemu_posts', function (Blueprint $table) {
            // Add foreign key to insideemu_ideas table
						$table->unsignedBigInteger('insideemu_idea_id')->nullable();
						$table->foreign('insideemu_idea_id')->references('id')->on('insideemu_ideas')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('insideemu_posts', function (Blueprint $table) {
            // Drop foreign key to insideemu_ideas table
						$table->dropForeign(['insideemu_idea_id']);
        });
    }
};
