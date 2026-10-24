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
        Schema::create('foto_return_produks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('return_produk_id')->constrained('return_produk')->cascadeOnDelete();
            $table->string('foto_path');
            $table->timestamps();
            $table->index('return_produk_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto_return_produks');
    }
};
