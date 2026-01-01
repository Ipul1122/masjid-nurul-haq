<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('muhasabah_soals', function (Blueprint $table) {
            $table->id();
            $table->string('pertanyaan'); 
            $table->string('deskripsi')->nullable();
            $table->enum('tipe_soal', ['short_text', 'paragraph', 'radio', 'checkbox']); 
            $table->json('opsi_jawaban')->nullable(); 
            $table->integer('urutan')->default(1);
            $table->boolean('is_active')->default(true); // Bisa disembunyikan tanpa dihapus
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('muhasabah_soals');
    }
};