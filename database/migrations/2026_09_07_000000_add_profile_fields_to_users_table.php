
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->date('tanggal_lahir')->nullable()->after('password');
            $table->text('alamat')->nullable()->after('tanggal_lahir');
            $table->string('foto_profil')->nullable()->after('alamat');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->dropColumn(['tanggal_lahir', 'alamat', 'foto_profil']);
        });
    }
};