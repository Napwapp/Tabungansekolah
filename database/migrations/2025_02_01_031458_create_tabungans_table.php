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
            $table->unsignedBigInteger('user_id'); // Menghubungkan ke tabel users
            $table->string('tabungan_id')->unique(); // ID tabungan unik, misalnya bisa di-generate\n       $table->decimal('saldo', 15, 2)->default(0); // Saldo awal\n       $table->timestamps();\n\n       // Constraint foreign key\n       $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');\n   });
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
