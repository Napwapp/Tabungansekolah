<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('informasi_kontak', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->integer('id_informasi_kontak')->unsigned();
        $table->string('nomor', 15);
        $table->timestamps();

        // Batasan hanya boleh ada 3 data kontak (1, 2, 3)
        $table->unique(['id_informasi_kontak']);
        $table->unique('nomor'); // Pastikan nomor telepon juga unik secara global
    });
}

public function down()
{
    Schema::dropIfExists('informasi_kontak');
}

};
