<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('adopsis', function (Blueprint $table) {
        $table->string('jenis_hewan')->nullable();  // Menambahkan kolom jenis_hewan
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('adopsis', function (Blueprint $table) {
        $table->dropColumn('jenis_hewan');  // Menghapus kolom jenis_hewan jika rollback
    });
}
};
