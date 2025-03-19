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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();

            $table->string('full_name')->nullable();
            $table->string('en_full_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('id_number')->nullable();
            $table->date('id_expiry_at')->nullable();
            $table->date('dob')->nullable();
            $table->string('image')->nullable();

            $table->string('license_number')->nullable();
            $table->date('license_expiry_at')->nullable();

            $table->foreignId('nationality_id')->constrained('nationalities')->onDelete('cascade');
            $table->foreignId('driver_contract_type_id')->constrained('driver_contract_types')->onDelete('cascade');

            $table->integer('current_vehicle_id')->nullable();
            $table->integer('current_project_id')->nullable();

            $table->string('address')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
