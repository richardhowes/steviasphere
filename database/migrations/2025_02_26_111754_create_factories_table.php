<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('factories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organisation_id')
                  ->constrained()
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->string('name');

            // Suggested fields for traceability and location
            $table->string('location')->nullable();    // e.g. city, region name
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            // If you prefer a more precise location structure, you might use:
            //  - an address field for storing the full address 
            //  - region, city, postal_code, etc.

            // Additional fields, e.g. capacity, manager_name, phone, etc.
            // $table->string('manager_name')->nullable();
            // $table->string('phone')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('factories');
    }
};
