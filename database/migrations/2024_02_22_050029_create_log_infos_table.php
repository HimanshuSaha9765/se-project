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
        Schema::create('log_infos', function (Blueprint $table) {
            $table->id();
            $table->string('table_id')->nullable()->index();

            $table->string('created_ip')->nullable();
            $table->string('created_name')->nullable();
            $table->string('created_email')->nullable();
            $table->string('created_date')->nullable();

            $table->string('updated_ip')->nullable();
            $table->string('updated_name')->nullable();
            $table->string('updated_email')->nullable();
            $table->string('updated_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_infos');
    }
};
