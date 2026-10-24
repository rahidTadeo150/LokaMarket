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
        Schema::create('penarikan_saldo', function (Blueprint $table) {
            $table->id();

            $table->foreignId('saldo_penjual_id')->constrained('saldo_penjual')->cascadeOnDelete();
            $table->foreignId('rekening_penjual_id')->constrained('rekening_penjual')->restrictOnDelete();
            $table->foreignId('diproses_oleh')->nullable()->constrained('users')->nullOnDelete();

            $table->string('nomor_penarikan')->unique();
            $table->unsignedBigInteger('jumlah');
            $table->string('status')->default('menunggu');

            $table->string('referensi_transfer')->nullable();
            $table->text('catatan_admin')->nullable();
            $table->timestamp('diproses_pada')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penarikan_saldo');
    }
};
