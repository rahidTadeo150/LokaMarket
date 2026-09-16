<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            
            $table->string('nomor_pesanan')->unique();
            $table->string('nama_penerima');
            $table->string('no_telepon', 20);
            
            $table->foreignId('provinsi_id')->constrained('provinsi')->restrictOnDelete();
            $table->foreignId('kota_id')->constrained('kota')->restrictOnDelete();
            $table->foreignId('kecamatan_id')->constrained('kecamatan')->restrictOnDelete();

            $table->string('kode_pos', 5);
            $table->text('alamat_lengkap');
            $table->text('catatan')->nullable();
            $table->decimal('subtotal', 15, 2);
            $table->decimal('ongkir', 15, 2)->default(0);
            $table->decimal('total_pembayaran', 15, 2);

            // Status pesanan
            $table->enum('status', [
                'menunggu_pembayaran',
                'dibayar',
                'diproses',
                'dikirim',
                'selesai',
                'dibatalkan'
            ])->default('menunggu_pembayaran');

            $table->timestamp('dibayar_at')->nullable();
            $table->timestamp('selesai_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};