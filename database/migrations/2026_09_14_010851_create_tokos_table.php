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
        Schema::create('toko', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('nama_toko');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->text('alamat_lengkap')->nullable();
            $table->string('no_telepon')->nullable();
            $table->string('foto_profil')->nullable();
            $table->foreignId('provinsi_id')->constrained('provinsi')->restrictOnDelete();
            $table->foreignId('kota_id')->constrained('kota')->restrictOnDelete();
            $table->foreignId('kecamatan_id')->constrained('kecamatan')->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('toko');
    }
};
