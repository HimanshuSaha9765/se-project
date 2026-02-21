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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('info_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile_number');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('ip_address')->nullable();
            $table->string('login_time')->nullable();
            $table->string('last_login_time')->nullable();
            $table->enum('status', ['active', 'inactive', 'deleted'])->default('inactive');
            $table->enum('role', ['admin','employee', 'dealer', 'installer'])->default('employee');
            $table->timestamps();

            $table->foreign('info_id')->references('table_id')->on('log_infos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
