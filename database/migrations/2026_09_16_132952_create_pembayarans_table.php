<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pesanan_id')->constrained('pesanan')->cascadeOnDelete();
            
            $table->string('metode');
            $table->string('status')->default('pending');
            $table->string('transaction_id')->nullable()->unique();
            $table->decimal('jumlah', 15, 2);
            $table->text('snap_token')->nullable();
            $table->timestamp('dibayar_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};