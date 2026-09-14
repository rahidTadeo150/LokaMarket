<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pending_pengajuan_toko', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('nama_toko');
            $table->string('slug');
            $table->text('deskripsi')->nullable();
            $table->string('foto_profil')->nullable();

            $table->foreignId('provinsi_id')
                ->constrained('provinsi')
                ->restrictOnDelete();

            $table->foreignId('kota_id')
                ->constrained('kota')
                ->restrictOnDelete();

            $table->foreignId('kecamatan_id')
                ->constrained('kecamatan')
                ->restrictOnDelete();

            $table->string('kode_pos', 5);
            $table->text('alamat_lengkap');
            $table->string('no_telepon', 20);

            $table->string('foto_ktp');

            $table->string('token_verifikasi', 100)->unique();

            $table->timestamp('token_expired_at');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pending_pengajuan_toko');
    }
};