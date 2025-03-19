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
        Schema::create('order_messages', function (Blueprint $table) {
            $table->id();

            // Foreign key to the orders table
            $table->foreignId('order_id')->constrained()->onDelete('cascade')->comment('Foreign key to the orders table');

            // Sender ID (user who sent the message, e.g., admin or user)
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade')->comment('Foreign key to the users table (sender)');

            // Receiver ID (user who receives the message, e.g., admin or user)
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade')->comment('Foreign key to the users table (receiver)');

            // The message content
            $table->text('message')->comment('The content of the message');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_messages');
    }
};
