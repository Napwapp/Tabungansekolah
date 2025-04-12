<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('informasi_email', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('id_informasi_email')->unsigned();
            $table->string('email', 100);
            $table->timestamps();

            // Batasan hanya boleh ada 3 data email (1, 2, 3)
            $table->unique(['id_informasi_email']);
            $table->unique(['email']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('informasi_email');
    }
};
