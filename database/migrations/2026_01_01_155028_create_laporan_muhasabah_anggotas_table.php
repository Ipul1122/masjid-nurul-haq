<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_muhasabah_anggotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->constrained('muhasabah_anggotas')->onDelete('cascade');
            $table->foreignId('muhasabah_soal_id')->constrained('muhasabah_soals')->onDelete('cascade');
            
            $table->text('jawaban')->nullable(); // Isi jawaban
            $table->date('tanggal'); // Tanggal pengisian (muhasabah hari apa)
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_muhasabah_anggotas');
    }
};