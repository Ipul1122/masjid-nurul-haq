<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galeri_risnhas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_galeri');
            
            // relasi ke kategori_galeri_risnhas
            $table->unsignedBigInteger('kategori_galeri_risnha_id');
            $table->foreign('kategori_galeri_risnha_id')
                  ->references('id')
                  ->on('kategori_galeri_risnhas')
                  ->onDelete('cascade');
            
            $table->string('foto'); // path file foto
            $table->text('deskripsi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri_risnhas');
    }
};
