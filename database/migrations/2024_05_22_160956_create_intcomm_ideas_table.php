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
        Schema::create('insideemu_ideas', function (Blueprint $table) {
					$table->id();
					$table->string('title', 255);
					$table->string('teaser', 100)->nullable();
					$table->text('content')->nullable();
					$table->string('submitted_by', 8)->nullable();
					$table->enum('status', ['Draft', 'Submitted'])->default('Draft');
					$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insideemu_ideas', function (Blueprint $table) {
            //
        });
    }
};
