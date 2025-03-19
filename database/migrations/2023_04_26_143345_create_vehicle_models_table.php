<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_models', function (Blueprint $table) {
            $table->id();

       
            $table->string('name')->nullable();
            $table->string('en_name')->nullable();
            $table->boolean('is_active')->default(1)->nullable();
            $table->integer('sorting')->default(99)->nullable();


            $table->foreignId('vehicle_manufacturer_id')->constrained();

            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_models');
    }
};
