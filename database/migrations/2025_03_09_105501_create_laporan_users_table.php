<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('laporan_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // ID user yang mengirim laporan/saran
            $table->string('nama_pengirim'); // Nama pengirim laporan
            $table->string('foto_pengirim')->nullable(); // Foto profil pengirim (opsional)
            $table->string('judul'); // Judul laporan/saran
            $table->text('isi_pesan'); // Deskripsi laporan/saran
            $table->enum('tipe', ['Laporan', 'Saran']); // Tipe laporan atau saran
            $table->enum('status_laporan', ['Terkirim', 'Dibaca_Admin', 'Dibalas'])->default('Terkirim'); // Status laporan
            $table->timestamps(); // created_at & updated_at

            // Relasi ke tabel users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_users');
    }
};
