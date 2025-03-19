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
        Schema::create('order_activities', function (Blueprint $table) {
            $table->id();

            // Foreign key to the orders table
            $table->foreignId('order_id')->constrained()->onDelete('cascade')->comment('Foreign key to the orders table');
            $table->string('current_status')->nullable();

            // The type of activity (e.g., status change, payment, etc.)
            $table->string('activity_type')->comment('The type of activity (status change, payment, etc.)');

            // Description of the activity
            $table->text('description')->nullable()->comment('Description of the activity');

            // User who performed the action
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->comment('Foreign key to the users table');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_activities');
    }
};
