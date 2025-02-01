<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tabungans', function (Blueprint $table) {
            $table->id(); // Primary Key (Auto Increment)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relasi ke tabel users
            $table->decimal('saldo', 15, 2)->default(0); // Saldo tabungan dengan format desimal
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('tabungans');
    }
};
