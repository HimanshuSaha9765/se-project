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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('info_id')->nullable();
            $table->string('consumer_number')->unique()->index();
            $table->string('user_email_id')->index()->nullable();
            $table->string('name')->nullable();
            $table->string('mobile_number')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('bill_amount')->nullable();
            $table->string('kw')->nullable();
            $table->string('structure_length')->nullable();
            $table->string('structure_width')->nullable();
            $table->string('structure_height')->nullable();
            $table->string('quotation_amount')->nullable();
            $table->string('reference_by')->nullable();
            $table->string('structure_image')->nullable();
            $table->string('address')->nullable();
            $table->enum('process_of_client', ['Yes', 'No'])->default('No');
            $table->enum('status', ['active', 'inactive', 'deleted'])->default('active');
            $table->timestamps();

            $table->foreign('info_id')->references('table_id')->on('log_infos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
