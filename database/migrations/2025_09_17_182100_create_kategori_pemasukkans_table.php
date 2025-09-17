<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori_pemasukkans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
        });

        Schema::table('pemasukkans', function (Blueprint $table) {
            $table->foreignId('kategori_id')
                  ->nullable()
                  ->constrained('kategori_pemasukkans')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('pemasukkans', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->dropColumn('kategori_id');
        });

        Schema::dropIfExists('kategori_pemasukkans');
    }
};
