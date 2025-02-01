<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::create('tabungan', function (Blueprint $table) {
    //         $table->id();
    //         $table->unsignedBigInteger('user_id'); // Relasi ke tabel users\n      $table->string('tabungan_id')->unique(); // ID tabungan unik\n      $table->decimal('saldo', 15, 2)->default(0); // Saldo tabungan\n      $table->timestamps();\n\n      // Foreign key constraint\n      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');\n  });\n  ```
    //     });
    // }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabungan');
    }
};
