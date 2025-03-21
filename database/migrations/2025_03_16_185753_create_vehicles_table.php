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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();

            $table->string('plate_number')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('chassis_number')->nullable();
            $table->string('registration_number')->nullable();
            $table->date('form_expiration')->nullable();

            $table->foreignId('plate_registration_type_id')->constrained();
            $table->foreignId('vehicle_manufacturer_id')->constrained();
            $table->integer('vehicle_manufacturer_year')->nullable();

            $table->foreignId('vehicle_model_id')->constrained();
            $table->foreignId('vehicle_color_id')->constrained();
            $table->foreignId('vehicle_status_id')->constrained();
            $table->foreignId('vehicle_type_id')->constrained();

            $table->foreignId('vehicle_supplier_id')->constrained();

            $table->date('ownership_date')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
