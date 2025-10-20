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
        Schema::create('artikel_risnhas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('kategori_artikel_risnha_id')->constrained('kategori_artikel_risnhas')->onDelete('cascade');
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
        Schema::dropIfExists('artikel_risnhas');
    }
};
