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
            $table->softDeletes(); // Ini akan membuat kolom deleted_at
        });
    }

    public function down()
    {
        Schema::table('notifikasi_users', function (Blueprint $table) {
            $table->dropColumn('deleted_at'); // Menghapus kolom deleted_at jika rollback
        });
    }
};
