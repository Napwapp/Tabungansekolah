<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('tabungan_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Hubungkan ke tabel users
            $table->integer('jumlah_tabungan'); // Nominal yang ditabung
            $table->enum('jenis_transaksi', ['menabung', 'penarikan']); // Tipe transaksi
            $table->timestamps(); // Waktu transaksi
        });
    }

    public function down() {
        Schema::dropIfExists('tabungan_transactions');
    }
};
