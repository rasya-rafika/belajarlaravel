<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_xx_xx_create_pengajuan_adopsis_table.php
public function up()
{
    Schema::create('pengajuan_adopsi', function (Blueprint $table) {
        $table->id();
        $table->foreignId('adopsi_id')->constrained('adopsis')->onDelete('cascade');
        $table->string('nama_pengaju');
        $table->string('alamat');
        $table->string('nomor_telepon');
        $table->text('alasan_adopsi');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_adopsi');
    }
};
