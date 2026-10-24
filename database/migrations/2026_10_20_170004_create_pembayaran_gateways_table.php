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
        Schema::create('pembayaran_gateway', function (Blueprint $table) {
            $table->id();

            $table->string('provider');
            $table->string('event_id');
            $table->string('payment_id')->nullable();
            $table->foreignId('pesanan_id')->nullable()->constrained('pesanan')->nullOnDelete();

            $table->string('status');
            $table->timestamp('terverifikasi_pada')->nullable();
            $table->timestamps();

            $table->unique(['provider', 'event_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_gateway');
    }
};
