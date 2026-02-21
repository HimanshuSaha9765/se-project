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
        Schema::create('wiring_accessories', function (Blueprint $table) {
            $table->id();
            $table->string('info_id')->nullable();
            $table->string('accessories_name');
            $table->string('unit')->nullable();
            $table->integer('quantity')->nullable();
            $table->enum('status', ['active', 'inactive', 'deleted'])->default('active');
            $table->timestamps();
            $table->foreign('info_id')->references('table_id')->on('log_infos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wiring_accessories');
    }
};
