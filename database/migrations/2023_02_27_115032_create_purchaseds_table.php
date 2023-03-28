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
        Schema::create('purchaseds', function (Blueprint $table) {
            $table->id();
            $table->string('product_title')->nullable();
            $table->string('product_category')->nullable();
            $table->string('purchase_price')->nullable();
            $table->string('quantity')->nullable();
            $table->string('item_id')->nullable();
            $table->string('purchase_id')->nullable();
            $table->string('total_price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchaseds');
    }
};
