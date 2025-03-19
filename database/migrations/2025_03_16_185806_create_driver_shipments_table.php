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
        Schema::create('driver_shipments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');

            $table->foreignId('driver_id')->constrained();
            $table->integer('total_orders')->nullable();
            $table->integer('delivered_orders')->nullable();
            $table->integer('not_delivered_orders')->nullable();
            $table->text('return_reasons')->nullable();
            $table->timestamp('orders_date')->nullable();

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
        Schema::dropIfExists('driver_shipments');
    }
};
