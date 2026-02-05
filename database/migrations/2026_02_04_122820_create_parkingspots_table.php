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
        Schema::create('parkingspots', function (Blueprint $table) {
            $table->id();
            $table->string('location');
            $table->enum('type', ['normal', 'electric', 'disabled', 'compact']);
            $table->enum('status', ['available', 'occupied', 'maintenance']);
            $table->enum('vehicle_fuel_type', ['petrol', 'diesel', 'electric', 'hybrid']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parkingspots');
    }
};
