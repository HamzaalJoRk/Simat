<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('simats', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mother_name')->nullable();
            $table->string('nationality');
            $table->string('serial_number');
            $table->string('birth_date');
            $table->string('passport_number');
            $table->string('entry_date');
            $table->string(column: 'visa_type');
            $table->string('validity_duration');
            $table->decimal('fee_number', 10, 2);
            $table->string('fee_text');
            $table->string('country_code');
            $table->decimal('labor_fee', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simats');
    }
};
