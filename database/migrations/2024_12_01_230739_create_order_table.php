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
            $table->enum('status',['pending','confirmed','processing','delivered_to_pathao','delivered'])->default('Pending');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('order_number')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone_no')->nullable();
            $table->string('customer_address')->nullable();
            $table->string('delivery_date')->nullable();
            $table->string('location')->nullable();
            $table->string('discount_code')->nullable();
            $table->double('discount',12,2)->nullable(0);
            $table->bigInteger('total_quantity')->nullable(0);
            $table->double('subtotal',12,2)->nullable(0);
            $table->double('shipping_fee',12,2)->nullable(0);
            $table->double('total_price',12,2)->nullable(0);

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
