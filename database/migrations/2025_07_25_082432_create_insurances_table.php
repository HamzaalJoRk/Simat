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
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->string('vehicle_type'); 
            $table->string('model'); 
            $table->string('chassis_number'); 
            $table->string('plate_number'); 
            $table->date('start_date');
            $table->date('end_date'); 
            $table->string('duration'); 
            $table->decimal('amount_numeric', 10, 2); 
            $table->string('amount_written'); 
            $table->string('serial_number');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurances');
    }
};
