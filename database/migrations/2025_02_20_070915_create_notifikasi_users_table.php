<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('notifikasi_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_pengirim'); // Nama pengirim
            $table->string('foto_pengirim')->nullable(); // Foto pengirim
            $table->string('judul'); // Judul notifikasi
            $table->text('isi_pesan'); // Isi pesan
            $table->enum('status', ['Belum Dibaca', 'Dibaca'])->default('Belum Dibaca'); // Status notifikasi
            $table->enum('tipe', ['Transaksi', 'Pengingat', 'Target Tercapai']); // Tipe notifikasi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifikasi_users');
    }
};
