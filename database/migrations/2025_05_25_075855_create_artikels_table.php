<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artikels', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('link_artikel');
            $table->text('deskripsi');
            $table->string('gambar')->nullable();
            $table->unsignedBigInteger('user_id');  // Menambahkan kolom user_id
            $table->timestamps();

            // Menambahkan foreign key yang mengarah ke kolom id pada tabel users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Menambahkan relasi
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artikels');
    }
};
