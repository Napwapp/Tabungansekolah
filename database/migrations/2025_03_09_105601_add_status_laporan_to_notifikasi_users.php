<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('notifikasi_users', function (Blueprint $table) {
            $table->enum('status_laporan', ['Terkirim', 'Dibaca_Admin', 'Dibalas'])->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('notifikasi_users', function (Blueprint $table) {
            $table->dropColumn('status_laporan');
        });
    }
};
