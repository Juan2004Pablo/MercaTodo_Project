<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pays', function (Blueprint $table)
        {
            $table->id();
            $table->string('reference',10)->unique();
            $table->enum('status', ['PENDING', 'APPROVED', 'REJECTED'])->default('PENDING');
            $table->unSignedBigInteger('requestId')->unique();
            $table->string('process_url');
            $table->unsignedBigInteger('user_id');
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('document_type')->nullable();
            $table->unsignedBigInteger('document')->nullable();
            $table->string('email')->nullable();
            $table->unsignedBigInteger('phone')->nullable();
            $table->string('payment_method')->nullable();
            $table->unSignedBigInteger('order_total');
            $table->foreign('user_id')->references('user_id')->on('orders');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pays');
    }
};
