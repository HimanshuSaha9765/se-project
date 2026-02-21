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
        Schema::create('sell_products', function (Blueprint $table) {
            $table->id();
            $table->string('info_id')->nullable();
            $table->string('consumer_number')->nullable();
            $table->string('product_id')->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_quantity')->nullable();
            $table->string('date')->nullable();
            $table->timestamps();

            $table->foreign('info_id')->references('table_id')->on('log_infos')->onDelete('cascade');
            $table->foreign('consumer_number')->references('consumer_number')->on('clients')->onDelete('cascade');
            $table->foreign('product_id')->references('product_id')->on('stocks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sell_products');
    }
};
