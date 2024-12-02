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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('category_id') // Define foreign key in one step
            ->constrained('categories') // Table name for the foreign key
            ->onDelete('cascade');
            $table->string('description');
            $table->double('price',8,2);
            $table->boolean('has_discount');
            $table->double('discount_price',8,2);
            $table->timestamp('discount_date');
            $table->string('color');
            $table->string('sku');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
