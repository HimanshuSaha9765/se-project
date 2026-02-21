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
        Schema::create('client_trackings', function (Blueprint $table) {
            $table->id();
            $table->string('consumer_number');
            $table->string('application_number_1')->nullable();
            $table->string('appication_1')->nullable();
            $table->string('amount_1')->nullable();
            $table->string('document_verified_2')->nullable();
            $table->string('resion_2')->nullable();
            $table->string('metter_fee_3')->nullable();
            $table->string('fesibility_approved_4')->nullable();
            $table->string('resion_4')->nullable();
            $table->string('structure_image_5')->nullable();
            $table->string('make_of_module_6')->nullable();
            $table->string('sr_no_module_6')->nullable();
            $table->string('module_mount_image_6')->nullable();
            $table->string('inverter_image7')->nullable();
            $table->string('serial_number_image7')->nullable();
            $table->string('serial_number7')->nullable();
            $table->string('perform_8')->nullable();
            $table->string('form_16_8')->nullable();
            $table->string('jr_form_9')->nullable();
            $table->string('subsidy_clamp_9')->nullable();
            $table->string('amount_9')->nullable();
            $table->string('description_9')->nullable();
            $table->string('recived_9')->nullable();
            $table->string('pdf_9')->nullable();
            $table->timestamps();

            $table->foreign('consumer_number')->references('consumer_number')->on('clients');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_trackings');
    }
};
