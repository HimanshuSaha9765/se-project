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
        Schema::create('client_materials', function (Blueprint $table) {
            $table->id();
            $table->string("consumer_number")->nullable();
            $table->string("structure")->nullable();
            $table->string("total_structure_qty")->nullable();
            $table->string("panel")->nullable();
            $table->string("total_panel_qty")->nullable();
            $table->string("inverter")->nullable();
            $table->string("total_inverter_qty")->nullable();
            $table->string("cable")->nullable();
            $table->string("total_cable_qty")->nullable();
            $table->string("wiring")->nullable();
            $table->string("total_wiring_qty")->nullable();
            $table->string("date")->nullable();
            $table->timestamps();

            $table->foreign('consumer_number')->references('consumer_number')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_materials');
    }
};
