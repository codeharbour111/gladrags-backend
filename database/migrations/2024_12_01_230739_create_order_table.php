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
        Schema::create('order', function (Blueprint $table)
        {
            $table->id();
            $table->enum('status','Pending','Delivered','Out for delivery','Cancelled','Accepted')->default('Pending');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('order_number');
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone_no')->nullable();
            $table->string('customer_address')->nullable();
            $table->string('delivery_date');
            $table->double('total_price',12,2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};