<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_xx_xx_create_adopsis_table.php
public function up()
{
    Schema::create('adopsis', function (Blueprint $table) {
        $table->id();
        $table->string('nama_hewan');
        $table->string('jenis_kelamin');
        $table->integer('umur');
        $table->text('deskripsi');
        $table->string('gambar')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adopsis');
    }
};
