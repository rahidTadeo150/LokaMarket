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
        Schema::create('pesanan_toko', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained('pesanan')->cascadeOnDelete();
            $table->foreignId('toko_id')->constrained('toko')->restrictOnDelete();
            $table->decimal('subtotal', 15, 2)->default(0);
            $table->decimal('ongkir', 15, 2)->default(0);
            $table->decimal('komisi', 15, 2)->default(0);
            $table->decimal('total_penjual', 15, 2)->default(0);
            $table->string('status', 30)->default('menunggu_pembayaran');
            $table->string('nomor_resi')->nullable();
            $table->timestamp('dikirim_at')->nullable();
            $table->timestamp('selesai_at')->nullable();
            $table->timestamps();
            $table->unique(
                ['pesanan_id', 'toko_id'],
                'pesanan_toko_unique'
            );
            $table->index(['toko_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan_toko');
    }
};
