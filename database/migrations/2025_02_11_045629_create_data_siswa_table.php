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
        Schema::create('data_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('kelas', 20);
            $table->string('jurusan', 50);
            $table->decimal('total_saldo', 10, 2)->unsigned()->default(0);
            $table->decimal('setoran', 10, 2)->unsigned()->default(0);
            $table->decimal('penarikan', 10, 2)->unsigned()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_siswa');
    }
};
