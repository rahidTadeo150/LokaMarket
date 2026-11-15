
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('foto_ulasan_produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ulasan_produk_id')->constrained('ulasan_produk')->cascadeOnDelete();
            $table->string('foto');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('foto_ulasan_produk');
    }
};
