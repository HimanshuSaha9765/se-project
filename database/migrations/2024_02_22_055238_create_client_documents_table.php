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
        Schema::create('client_documents', function (Blueprint $table) {
            $table->id();
            $table->string('info_id')->nullable();
            $table->string('consumer_number')->unique();
            $table->string('light_bill')->nullable();
            $table->string('text_bill')->nullable();
            $table->string('adharcard_number')->nullable();
            $table->string('adharcard_image')->nullable();
            $table->string('passport_size_image')->nullable();
            $table->string('pancard')->nullable();
            $table->string('bank_proof')->nullable();
            $table->string('final_confirm_amount')->nullable();
            // Variation amoun in store to payment method 
            $table->string('variation_amount')->nullable();
            $table->string('deposit')->nullable();
            $table->string('due_amount')->nullable();
            $table->timestamps();

            $table->foreign('info_id')->references('table_id')->on('log_infos')->onDelete('cascade');
            $table->foreign('consumer_number')->references('consumer_number')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_documents');
    }
};
