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
        Schema::table('penarikan_users', function (Blueprint $table) {
            $table->string('namalengkap')->after('user_id');
            $table->string('kelas')->after('namalengkap');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('penarikan_users', function (Blueprint $table) {
            $table->dropColumn(['namalengkap', 'kelas']);
        });
    }
};
