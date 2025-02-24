<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('penarikan_users', function (Blueprint $table) {
            $table->enum('status', ['Sukses', 'Menunggu Persetujuan', 'Gagal'])->default('Menunggu Persetujuan')->change();
        });
    }

    public function down() {
        Schema::table('penarikan_users', function (Blueprint $table) {
            $table->string('status')->default('menunggu')->change();
        });
    }
};
