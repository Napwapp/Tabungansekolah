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
        Schema::create('tabungans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa');
            $table->unsignedBigInteger('kelas_id');
            $table->decimal('saldo', 10, 2);
            $table->timestamps();

            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');

            Schema::create('kelas', function (Blueprint $table) {
                $table->id();
                $table->string('nama_kelas');
                $table->timestamps();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabungans');
    }
};
