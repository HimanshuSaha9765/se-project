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
        Schema::create('panel_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('info_id')->nullable();
            $table->string('panel_id');
            $table->string('total_qty');
            $table->string('used_qty')->nullable();
            $table->string('remaining_qty')->nullable();
            $table->string('date');
            $table->enum('status', ['active', 'inactive', 'deleted'])->default('active');
            $table->timestamps();
            $table->foreign('info_id')->references('table_id')->on('log_infos')->onDelete('cascade');
            $table->foreign('panel_id')->references('info_id')->on('panels');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panel_stocks');
    }
};
