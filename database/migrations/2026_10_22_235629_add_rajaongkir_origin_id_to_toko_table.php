<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('toko', function (Blueprint $table) {
            Schema::table('toko', function (Blueprint $table) {
                $table->unsignedBigInteger('rajaongkir_origin_id')
                    ->nullable()
                    ->after('kecamatan_id');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('toko', function (Blueprint $table) {
            Schema::table('toko', function (Blueprint $table) {
                $table->dropColumn('rajaongkir_origin_id');
            });
        });
    }
};
