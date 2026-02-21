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
        Schema::create('branch_locations', function (Blueprint $table) {
            $table->id();
            $table->string("info_id")->nullable();
            $table->string("branch_location_name")->nullable();
            $table->string("address")->nullable();
            $table->string("email")->nullable();
            $table->string("mobile_number")->nullable();
            $table->string("location_link")->nullable();
            $table->string("working_time")->default("Mon-Sat: 09:00 AM - 07:00 PM");
            $table->tinyInteger('is_head_branch')->nullable()->comment('1=Head, 2=Sub-Branch')->default('2');
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
        Schema::dropIfExists('branch_locations');
    }
};
