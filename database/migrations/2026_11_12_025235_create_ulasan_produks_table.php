
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ulasan_produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('produk_id')->constrained('produk')->cascadeOnDelete();
            $table->foreignId('detail_pesanan_id')->constrained('detail_pesanan')->cascadeOnDelete();
            $table->unsignedTinyInteger('rating');
            $table->text('ulasan');
            $table->json('tag_ulasan')->nullable();
            $table->timestamps();
            $table->unique(
                'detail_pesanan_id',
                'ulasan_produk_detail_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ulasan_produk');
    }
};
