<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('transaksi_topup', function (Blueprint $table) {
            $table->softDeletes(); // Menambahkan kolom deleted_at
        });

        Schema::table('transaksi_menabung_users', function (Blueprint $table) {
        $table->softDeletes();
        });

        Schema::table('penarikan_users', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::table('transaksi_topup', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('transaksi_menabung_users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('penarikan_users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};

