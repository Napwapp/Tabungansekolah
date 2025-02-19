<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
        Schema::create('tabungan_users', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Hubungan ke tabel users
            $table->string('id_tabungan', 13)->unique(); // ID tabungan unik
            $table->decimal('saldo', 15, 2)->default(0); // Saldo awal Rp 0 (bisa ditambah)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabungan_users');
    }
};
