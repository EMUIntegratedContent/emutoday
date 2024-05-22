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
            // Add foreign key to intcomm_ideas table
						$table->unsignedBigInteger('intcomm_idea_id')->nullable();
						$table->foreign('intcomm_idea_id')->references('id')->on('intcomm_ideas')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('intcomm_posts', function (Blueprint $table) {
            // Drop foreign key to intcomm_ideas table
						$table->dropForeign(['intcomm_idea_id']);
        });
    }
};
