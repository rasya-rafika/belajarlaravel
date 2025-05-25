<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dokters', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('lokasi'); // lokasi singkat, untuk dropdown filter
            $table->text('alamat'); // detail lokasi dokter
            $table->string('jadwal'); // contoh: "Senin-Jumat, 08:00 - 16:00"
            $table->string('foto')->nullable(); // nama file foto
            $table->integer('pengalaman')->default(0); // dalam tahun
            $table->decimal('rating', 3, 2)->default(0.00); // rating akumulasi, contoh 4.75
            $table->integer('jumlah_rating')->default(0); // jumlah user yang memberi rating
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokters');
    }
};