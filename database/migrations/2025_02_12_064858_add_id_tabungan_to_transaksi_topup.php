<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('transaksi_topup', function (Blueprint $table) {
            $table->string('id_tabungan', 13)->nullable()->after('user_id');
            $table->foreign('id_tabungan')->references('id_tabungan')->on('tabungan_users')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::table('transaksi_topup', function (Blueprint $table) {
            $table->dropForeign(['id_tabungan']);
            $table->dropColumn('id_tabungan');
        });
    }
};
