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
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Link to countries table
            $table->foreignId('country_id')->nullable()->constrained('countries')->onDelete('cascade'); // Link to countries table
            $table->foreignId('city_id')->nullable()->constrained('cities')->onDelete('cascade'); // Link to cities table
            $table->foreignId('neighbourhood_id')->nullable()->constrained('neighbourhoods')->onDelete('cascade'); // Link to neighbourhoods table

            // Additional fields
            $table->string('location_lat')->nullable(); // Latitude for geolocation
            $table->string('location_lanf')->nullable(); // Longitude for geolocation
            $table->string('zip_code')->nullable(); // Zip Code (nullable for regions without postal codes)
            $table->text('address')->nullable(); // Full address, optional

            $table->boolean('is_default')->default(1)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_addresses');
    }
};
