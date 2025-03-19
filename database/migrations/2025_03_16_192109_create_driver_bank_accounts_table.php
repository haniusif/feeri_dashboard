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
        Schema::create('driver_bank_accounts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('driver_id')->constrained('drivers')->onDelete('cascade');
            $table->foreignId('bank_id')->constrained('banks')->onDelete('cascade');

            $table->integer('account_number')->nullable();
            $table->string('ipan')->nullable();

            $table->boolean('is_default')->default(0);

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
        Schema::dropIfExists('driver_bank_accounts');
    }
};
