<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('muhasabah_anggotas', function (Blueprint $table) {
            $table->id();
            // Ini kuncinya: Menghubungkan Anggota ke Group tertentu
            $table->foreignId('group_id')->constrained('muhasabah_groups')->onDelete('cascade');
            
            $table->string('nama_lengkap');
            $table->string('username')->unique(); // Login unik
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('muhasabah_anggotas');
    }
};