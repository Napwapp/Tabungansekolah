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
        Schema::table('notifikasi_users', function (Blueprint $table) {
            $table->enum('tipe', ['Transaksi', 'Pengingat', 'Target Tercapai', 'Laporan', 'Saran'])->change();
        });
    }

    public function down(): void
    {
        Schema::table('notifikasi_users', function (Blueprint $table) {
            $table->enum('tipe', ['Transaksi', 'Pengingat', 'Target Tercapai'])->change();
        });
    }
};
