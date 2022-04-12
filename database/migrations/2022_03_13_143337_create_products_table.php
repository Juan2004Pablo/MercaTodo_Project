<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table)
        {
            $table->id();
            $table->string('name', 100);
            $table->tinyText('description');
            $table->unsignedBigInteger('price');
            $table->unsignedInteger('quantity')->default(0);
            $table->timestamp('disable_at')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->enum('status', ['New', 'Used'])->default('New');
            $table->softDeletes();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
