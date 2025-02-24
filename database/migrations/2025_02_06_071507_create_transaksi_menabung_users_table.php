<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(){
        Schema::create('transaksi_menabung_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relasi ke users
            $table->string('id_tabungan', 13); // Sesuai dengan id_tabungan di tabungan_users
            $table->foreign('id_tabungan')->references('id_tabungan')->on('tabungan_users')->onDelete('cascade'); // Relasi ke tabungan_users
            $table->decimal('jumlah', 15, 2); // Jumlah yang ditabung
            $table->enum('status', ['berhasil', 'gagal', 'pending'])->default('berhasil'); // Status transaksi
            $table->timestamps();
        });
    }
    
    public function down(){
        Schema::dropIfExists('transaksi_menabung_users');
    }
    
};
