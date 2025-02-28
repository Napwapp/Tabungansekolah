<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('notifikasi_users', function (Blueprint $table) {
            $table->enum('status_transaksi', ['Sukses', 'Menunggu Persetujuan', 'Gagal'])->nullable()->after('tipe');
        });
    }

    public function down()
    {
        Schema::table('notifikasi_users', function (Blueprint $table) {
            $table->dropColumn('status_transaksi');
        });
    }
};
