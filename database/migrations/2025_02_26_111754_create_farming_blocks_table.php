<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('farming_blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organisation_id')
                  ->constrained()
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->string('name');                   // e.g. "Block A"
            $table->string('block_code')->unique();   // for traceability, e.g. "ORG-2025-A"

            // Suggested fields
            $table->string('soil_type')->nullable(); 
            $table->decimal('clay_content', 5, 2)->nullable();   // clay percentage
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('farming_blocks');
    }
};
