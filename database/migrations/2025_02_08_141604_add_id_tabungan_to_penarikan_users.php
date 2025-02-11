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
        Schema::table('penarikan_users', function (Blueprint $table) {
            $table->string('id_tabungan')->after('user_id'); // Pastikan sesuai dengan tipe data di tabungan_users
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penarikan_users', function (Blueprint $table) {
            $table->dropColumn('id_tabungan');
        });
    }
};
