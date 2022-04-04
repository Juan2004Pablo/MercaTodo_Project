<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('details', function (Blueprint $table)
        {
            $table->id();
            $table->unsignedBigInteger('unit_price');
            $table->integer('quantity')->default(0);
            $table->unsignedBigInteger('products_id');
            $table->unsignedBigInteger('order_id');
            $table->foreignId('products_id')->constrained();
            $table->foreignId('order_id')->constrained();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('details');
    }
};
