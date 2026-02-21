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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('product_id')->nullable()->index();
            $table->string('product_name')->nullable();
            $table->string('product_total_quantity')->nullable();
            $table->string('total_sell_quantity')->nullable();
            $table->string('total_remain_quantity')->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('product_id')->on('purchase_producs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
