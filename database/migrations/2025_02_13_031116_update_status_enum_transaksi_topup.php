<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStatusEnumTransaksiTopup extends Migration
{
    public function up()
    {
        Schema::table('transaksi_topup', function (Blueprint $table) {
            $table->enum('status', ['Sukses', 'Menunggu Persetujuan', 'Gagal'])->default('Menunggu Persetujuan')->change();
        });
    }

    public function down()
    {
        Schema::table('transaksi_topup', function (Blueprint $table) {
            $table->enum('status', ['Sukses', 'Menunggu Persetujuan', 'Gagal'])->default('Menunggu persetujuan')->change();
        });
    }
}
