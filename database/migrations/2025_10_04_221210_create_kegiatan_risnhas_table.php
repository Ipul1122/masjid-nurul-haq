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
            $table->foreignId('kategori_kegiatan_risnha_id')->constrained('kategori_kegiatan_risnhas')->onDelete('cascade');
            $table->string('nama');
            $table->string('gambar')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('status')->default('draft');
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
