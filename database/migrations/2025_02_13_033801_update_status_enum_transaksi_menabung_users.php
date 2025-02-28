<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('transaksi_menabung_users', function (Blueprint $table) {
            $table->enum('status', ['Sukses', 'Menunggu Persetujuan', 'Gagal'])->default('Menunggu Persetujuan')->change();
        });
    }

    public function down(): void
    {
        Schema::table('transaksi_menabung_users', function (Blueprint $table) {
            $table->enum('status', ['Sukses', 'Menunggu Persetujuan', 'Gagal'])->default('Sukses')->change();
        });
    }
};
