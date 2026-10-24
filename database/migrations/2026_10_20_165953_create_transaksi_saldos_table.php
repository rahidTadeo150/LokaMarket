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
        Schema::create('transaksi_saldo', function (Blueprint $table) {
             $table->id();

            $table->foreignId('saldo_penjual_id')->constrained('saldo_penjual')->cascadeOnDelete();
            $table->foreignId('pesanan_id')->nullable()->constrained('pesanan')->nullOnDelete();
            $table->foreignId('penarikan_saldo_id')->nullable()->constrained('penarikan_saldo')->nullOnDelete();
            $table->foreignId('pesanan_toko_id')->nullable()->constrained('pesanan_toko')->nullOnDelete();

            $table->string('referensi')->unique();
            $table->string('jenis');
            $table->string('status')->default('berhasil');
            $table->unsignedBigInteger('jumlah');
            $table->unsignedBigInteger('komisi')->default(0);
            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_saldo');
    }
};
