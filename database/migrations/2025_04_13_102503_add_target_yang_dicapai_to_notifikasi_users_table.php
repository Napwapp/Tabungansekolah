<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('notifikasi_users', function (Blueprint $table) {
            $table->bigInteger('target_yang_dicapai')->nullable()->after('status_transaksi');
        });
    }

    public function down()
    {
        Schema::table('notifikasi_users', function (Blueprint $table) {
            $table->dropColumn('target_yang_dicapai');
        });
    }
};
