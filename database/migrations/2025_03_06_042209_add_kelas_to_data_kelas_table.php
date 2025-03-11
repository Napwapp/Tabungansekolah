<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up() {
        Schema::table('data_kelas', function (Blueprint $table) {
            if (!Schema::hasColumn('data_kelas', 'kelas')) {
                $table->enum('kelas', ['10', '11', '12'])->after('id');
            }
        });
    }

    public function down() {
        Schema::table('data_kelas', function (Blueprint $table) {
            if (Schema::hasColumn('data_kelas', 'kelas')) {
                $table->dropColumn('kelas');
            }
        });
    }
};
