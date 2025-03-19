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
        Schema::create('vehicle_colors', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('en_name')->nullable();
            $table->string('color_code')->nullable();
            $table->boolean('is_active')->default(1)->nullable();
            $table->integer('sorting')->default(99)->nullable();


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
        Schema::dropIfExists('vehicle_colors');
    }
};
