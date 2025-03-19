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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_reference')->nullable()->comment('Reference ID for order');
            $table->foreignId('order_status_id')->nullable()->constrained('order_statuses')->onDelete('cascade');
            // Foreign key for related user
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->comment('Foreign key to the users table');
            // Order financial details
            $table->decimal('cod_amount', 10, 2)->nullable()->comment('The COD amount for the order');
            // Pickup Details
            $table->string('pickup_reference')->nullable()->comment('Reference for pickup');
            $table->string('pickup_name')->nullable()->comment('Name of pickup location');
            $table->string('pickup_phone_number')->nullable()->comment('Phone number of pickup location');

            $table->foreignId('pickup_country_id')->nullable()->constrained('countries')->onDelete('cascade');            // Link to countries table
            $table->foreignId('pickup_city_id')->nullable()->constrained('cities')->onDelete('cascade');                  // Link to cities table
            $table->foreignId('pickup_neighbourhood_id')->nullable()->constrained('neighbourhoods')->onDelete('cascade'); // Link to neighbourhoods table
            $table->string('pickup_address')->nullable()->comment('Address of pickup location');
            $table->string('pickup_latitude')->nullable()->comment('Latitude of pickup location');
            $table->string('pickup_longitude')->nullable()->comment('Longitude of pickup location');
            $table->timestamp('pickup_time')->nullable()->comment('Scheduled pickup time');

            // Dropoff (Delivery) Details
            $table->string('dropoff_reference')->nullable()->comment('Reference for dropoff');
            $table->string('dropoff_name')->nullable()->comment('Name of dropoff location');
            $table->string('dropoff_phone_number')->nullable()->comment('Phone number of dropoff location');

            $table->foreignId('dropoff_country_id')->nullable()->constrained('countries')->onDelete('cascade');            // Link to countries table
            $table->foreignId('dropoff_city_id')->nullable()->constrained('cities')->onDelete('cascade');                  // Link to cities table
            $table->foreignId('dropoff_neighbourhood_id')->nullable()->constrained('neighbourhoods')->onDelete('cascade'); // Link to neighbourhoods table

            $table->string('dropoff_address')->nullable()->comment('Address of dropoff location');
            $table->string('dropoff_latitude')->nullable()->comment('Latitude of dropoff location');
            $table->string('dropoff_longitude')->nullable()->comment('Longitude of dropoff location');
            $table->timestamp('dropoff_time')->nullable()->comment('Scheduled dropoff time');

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
