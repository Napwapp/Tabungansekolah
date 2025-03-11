<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('data_kelas', function (Blueprint $table) {
            $table->id();
            $table->enum('kelas', ['10', '11', '12']); // Ubah dari string menjadi enum
            $table->string('jurusan'); // Tambahkan kolom jurusan
            $table->decimal('pemasukan', 15, 2)->default(0);
            $table->decimal('pengeluaran', 15, 2)->default(0);
            $table->decimal('dana', 15, 2)->default(0);
            $table->decimal('akhir', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Balikkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kelas');
    }
};
