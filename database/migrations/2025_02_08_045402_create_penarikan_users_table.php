<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasTable('penarikan_users')) {
            Schema::create('penarikan_users', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->string('id_tabungan'); // Pastikan ini tipe string sesuai dengan tabel tabungan_users
                $table->integer('jumlah');
                $table->string('status')->default('menunggu');
                $table->timestamps();

                // Tambahkan foreign key secara manual karena id_tabungan bukan foreignId()
                $table->foreign('id_tabungan')->references('id_tabungan')->on('tabungan_users')->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('penarikan_users');
    }
};
