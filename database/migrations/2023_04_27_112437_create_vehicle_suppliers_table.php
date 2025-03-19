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
        Schema::create('vehicle_suppliers', function (Blueprint $table) {
            $table->id();

            $table->string('supplier_name')->nullable();
            $table->foreignId('id_type_id')->constrained();
            $table->string('id_number')->nullable();
            $table->string('id_image')->nullable();


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
        Schema::dropIfExists('vehicle_suppliers');
    }
};
