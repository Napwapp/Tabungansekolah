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
        Schema::table('laporan_users', function (Blueprint $table) {
            $table->string('email')->after('nama_pengirim');
        });
    }

    public function down()
    {
        Schema::table('laporan_users', function (Blueprint $table) {
            $table->dropColumn('email');
        });
    }
};
