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
        Schema::create('pengajuan_toko', function (Blueprint $table) {
            $table->id();

            // Pemilik pengajuan
            $table->foreignId('user_id') ->constrained('users')->cascadeOnDelete();

            // Informasi toko
            $table->string('nama_toko');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->string('foto_profil')->nullable();

            // Lokasi toko
            $table->foreignId('provinsi_id')->constrained('provinsi')->restrictOnDelete();
            $table->foreignId('kota_id')->constrained('kota')->restrictOnDelete();
            $table->foreignId('kecamatan_id')->constrained('kecamatan')->restrictOnDelete();

            $table->string('kode_pos', 5);
            $table->text('alamat_lengkap');
            $table->string('no_telepon', 20);
            $table->string('foto_ktp');
            $table->string('token_verifikasi', 100)->nullable()->unique();
            $table->timestamp('token_expired_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();

            // Status pengajuan
            $table->enum('status', [
                'pending',
                'approved',
                'rejected'
            ])->default('pending');

            $table->text('alasan_reject')->nullable();

            $table->foreignId('by_admin')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
                });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_toko');
    }
};
