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

        Schema::create('rajaongkir_lokasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kecamatan_id')->constrained('kecamatan')->cascadeOnDelete();
            $table->unsignedBigInteger('provider_destination_id')->unique();
            $table->string('province_name');
            $table->string('city_name');
            $table->string('district_name');
            $table->string('subdistrict_name')->nullable();
            $table->string('postal_code', 10);
            $table->timestamps();
            $table->index(['kecamatan_id', 'postal_code']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rajaongkir_lokasi');
    }
};
