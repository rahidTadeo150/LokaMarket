<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('users', 'name') && !Schema::hasColumn('users', 'username')) {
            Schema::table('users', function (Blueprint $table): void {
                $table->renameColumn('name', 'username');
            });
        }

        Schema::table('users', function (Blueprint $table): void {
            if (!Schema::hasColumn('users', 'no_telp')) {
                $table->string('no_telp', 20)->nullable()->unique()->after('email');
            }

            if (!Schema::hasColumn('users', 'jenis_kelamin')) {
                $table->enum('jenis_kelamin', [
                    'Laki-laki',
                    'Perempuan',
                    'Tidak ingin memberitahukan',
                ])->default('Tidak ingin memberitahukan')->after('password');
            }

            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', [
                    'customer',
                    'pemilik_toko',
                    'admin',
                ])->default('customer')->after('jenis_kelamin');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            if (Schema::hasColumn('users', 'no_telp')) {
                $table->dropUnique('users_no_telp_unique');
                $table->dropColumn('no_telp');
            }

            if (Schema::hasColumn('users', 'jenis_kelamin')) {
                $table->dropColumn('jenis_kelamin');
            }

            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
        });

        if (Schema::hasColumn('users', 'username') && !Schema::hasColumn('users', 'name')) {
            Schema::table('users', function (Blueprint $table): void {
                $table->renameColumn('username', 'name');
            });
        }
    }
};