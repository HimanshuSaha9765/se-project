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
        Schema::create('payment_logs', function (Blueprint $table) {
            $table->id();
            $table->string('info_id');
            $table->string('consumer_number');
            $table->string('payment_date');
            $table->string('type_of_various')->nullable();
            $table->string('various_amount')->nullable();
            $table->string('reason')->nullable();
            $table->string('payment_mode');
            $table->string('cheque_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('type_of_payment')->nullable();
            $table->string('transaction_number')->nullable();
            $table->string('final_confirm_amount')->nullable();
            $table->string('deposit')->nullable();
            $table->string('due_amount')->nullable();
            $table->string('recieved_amount');
            $table->string('total_amount');
            $table->enum('status', ['active', 'inactive', 'deleted'])->default('active');
            $table->timestamps();

            $table->foreign('info_id')->references('table_id')->on('log_infos')->onDelete('cascade');
            $table->foreign('consumer_number')->references('consumer_number')->on('client_documents');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_logs');
    }
};
