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

        Schema::create('order_packages', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')->constrained()->onDelete('cascade')->comment('Foreign key to the orders table');
            $table->string('package_name'); // Package Name
            $table->text('package_description')->nullable(); // Package Description

            $table->double('package_weight')->nullable()->comment('Weight of the items being shipped');
            $table->double('package_length')->nullable()->comment('Length of the items being shipped');
            $table->double('package_width')->nullable()->comment('Width of the items being shipped');
            $table->double('package_height')->nullable()->comment('Height of the items being shipped');
            $table->double('package_weight_vol')->nullable()->comment('Calculated weight volume of the items being shipped based on dimensions (Length x Width x Height)');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_packages');
    }
};
