<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTopupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_topup', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // ID user dari tabel users
            $table->string('namalengkap')->nullable(); // Mengambil dari users.namalengkap dan 
            $table->string('kelas')->nullable(); //users.kelas
            $table->decimal('jumlah', 10, 2); // Jumlah saldo yang di-top-up
            $table->enum('status', ['Sukses', 'Menunggu Persetujuan', 'Gagal'])->default('Sukses');
            $table->timestamps();

            // Foreign key untuk menghubungkan dengan tabel users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_topup');
    }
}
