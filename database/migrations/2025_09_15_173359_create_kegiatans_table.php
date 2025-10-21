<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('nama_ustadz');
            $table->string('gambar')->nullable();
            $table->dateTime('jadwal');
            $table->text('deskripsi')->nullable();
            $table->string('status')->default('draft');
            $table->unsignedInteger('views')->default(0); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};