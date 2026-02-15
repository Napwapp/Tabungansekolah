<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('transaksi_menabung_users', function (Blueprint $table) {
            $table->string('namalengkap')->nullable()->after('user_id');
            $table->string('kelas')->nullable()->after('namalengkap');
        });
    }

    public function down(): void
    {
        Schema::table('transaksi_menabung_users', function (Blueprint $table) {
            $table->dropColumn(['namalengkap', 'kelas']);
        });
    }
};

