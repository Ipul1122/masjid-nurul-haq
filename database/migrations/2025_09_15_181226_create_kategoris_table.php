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
        Schema::create('kategoris', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
        });

        Schema::table('kegiatans', function (Blueprint $table){
            $table->foreignId('kategori_id')->nullable()->constrained('kategoris')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kegiatans', function (Blueprint $table){
            $table->dropForeign(['kategori_id']);
            $table->dropColumn('kategori_id');
        });
        Schema::dropIfExists('kategoris');
    }
};
