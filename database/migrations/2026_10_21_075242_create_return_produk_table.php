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
        Schema::create('return_produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained('pesanan')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('alasan');
            $table->text('keterangan')->nullable();

            $table->enum('status', [
                'diajukan',
                'diproses',
                'disetujui',
                'ditolak',
                'selesai',
            ])->default('diajukan');

            $table->text('catatan_admin')->nullable();
            $table->timestamps();

            $table->index(['pesanan_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_produk');
    }
};
