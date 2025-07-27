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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nationality_id');
            $table->string('type');
            $table->string('duration');
            $table->string('entry_count');
            $table->decimal('amount', 10, 2);
            $table->timestamps();

            $table->foreign('nationality_id')->references('id')->on('nationalities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
