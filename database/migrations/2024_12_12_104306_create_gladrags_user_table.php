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
        // Schema::create('gladrags_user', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->id();
        //     $table->timestamps();
        // });

        Schema::create('gladrags_users', function (Blueprint $table) {
                       $table->id();
                       $table->string('email')->unique();
                       $table->string('password');
                       $table->string('name')->nullable();
                       $table->string('phone_no')->nullable();
                       $table->string('address')->nullable();
                       $table->string('city')->nullable();
                       $table->rememberToken();
                       $table->timestamps();
                });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gladrags_user');
    }
};
