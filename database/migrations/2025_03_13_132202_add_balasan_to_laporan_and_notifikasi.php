<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('laporan_users', function (Blueprint $table) {
            $table->text('balasan')->nullable()->after('isi_pesan');
        });

        Schema::table('notifikasi_users', function (Blueprint $table) {
            $table->text('balasan')->nullable()->after('isi_pesan');
        });
    }

    public function down()
    {
        Schema::table('laporan_users', function (Blueprint $table) {
            $table->dropColumn('balasan');
        });

        Schema::table('notifikasi_users', function (Blueprint $table) {
            $table->dropColumn('balasan');
        });
    }
};
