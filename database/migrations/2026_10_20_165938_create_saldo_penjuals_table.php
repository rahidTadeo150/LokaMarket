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
        Schema::create('saldo_penjual', function (Blueprint $table) {
            $table->id();

            $table->foreignId('toko_id')->unique()->constrained('toko')->cascadeOnDelete();

            $table->unsignedBigInteger('saldo_pending')->default(0);
            $table->unsignedBigInteger('saldo_tersedia')->default(0);
            $table->unsignedBigInteger('saldo_ditahan')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saldo_penjual');
    }
};
