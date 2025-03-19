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
        Schema::create('vehicle_handovers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('driver_id')->constrained();
            $table->foreignId('vehicle_id')->constrained();

            $table->double('meter_upon_handover')->nullable();
            $table->timestamp('authorization_start_date')->nullable();
            $table->timestamp('authorization_end_date')->nullable();

            $table->string('front_right_image')->nullable();
            $table->string('back_left_image')->nullable();

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
        Schema::dropIfExists('vehicle_handovers');
    }
};
