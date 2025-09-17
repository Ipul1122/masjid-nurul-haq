<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_imams', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // nama imam
            $table->string('gambar')->nullable();
            $table->enum('waktu_sholat', ['Subuh', 'Zhuhur', 'Ashar', 'Maghrib', 'Isya']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_imams');
    }
};
