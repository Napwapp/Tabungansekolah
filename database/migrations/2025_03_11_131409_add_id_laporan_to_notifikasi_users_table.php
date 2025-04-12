<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('notifikasi_users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_laporan')->nullable()->after('id'); // Menambahkan kolom id_laporan yang bisa bernilai null
        });
    }

    public function down()
    {
        Schema::table('notifikasi_users', function (Blueprint $table) {
            $table->dropColumn('id_laporan');
        });
    }
};
