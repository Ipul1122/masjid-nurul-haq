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
        Schema::create('kegiatan_risnhas', function (Blueprint $table) {
            $table->id();
            $table->integer('no')->nullable();
            $table->string('nama');
            $table->string('foto')->nullable();
            $table->text('deskripsi')->nullable();

            // 🔗 Foreign key ke kategori
            $table->unsignedBigInteger('kategori_kegiatan_risnha_id');
            $table->foreign('kategori_kegiatan_risnha_id')
                ->references('id')
                ->on('kategori_kegiatan_risnhas')
                ->onDelete('cascade'); // jika kategori dihapus, kegiatan ikut terhapus

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan_risnhas');
    }
};
