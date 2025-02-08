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
        Schema::create('dataanggota', function (Blueprint $table) {
            $table->id();
            $table->string('namalengkap');
            $table->string('email')->unique();
            $table->integer('id_tabungan')->length(10)->default(0);
            $table->string('kelas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dataanggota');
    }
};
