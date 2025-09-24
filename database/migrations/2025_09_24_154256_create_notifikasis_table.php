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
    Schema::create('notifikasis', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('dkm_id');
        $table->string('aksi'); // create, update, delete
        $table->string('tabel'); // artikel, galeri, pemasukkan
        $table->string('keterangan')->nullable(); // judul, nama dll
        $table->timestamps();

        $table->foreign('dkm_id')->references('id')->on('dkms')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasis');
    }
};
