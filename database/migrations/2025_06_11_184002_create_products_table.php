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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id');
            $table->string('item_name');
            $table->string('barcode')->nullable();
            $table->longText('description')->nullable();
            $table->date('expired_date')->nullable();
            $table->foreignId('sub_category');
            $table->foreignId('category');
            $table->string('item_type');
            $table->string('quantity');
            $table->string('alert_quantity')->nullable();
            $table->string('unit1')->nullable();
            $table->string('unit2')->nullable();
            $table->string('unit3')->nullable();
            $table->string('name1')->nullable();
            $table->string('name2')->nullable();
            $table->string('name3')->nullable();
            $table->string('purchase_price1')->nullable();
            $table->string('purchase_price2')->nullable();
            $table->string('purchase_price3')->nullable();
            $table->string('retail1')->nullable();
            $table->string('retail2')->nullable();
            $table->string('retail3')->nullable();
            $table->string('wholesale1')->nullable();
            $table->string('wholesale2')->nullable();
            $table->string('wholesale3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
