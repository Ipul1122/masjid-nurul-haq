<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('donasis', function (Blueprint $table) {
            $table->id();
            // nominal tidak boleh null
            $table->integer('nominal'); 
            
            // Atur nullable dan default value sesuai permintaan
            $table->string('nama_donatur')->nullable()->default('Hamba Allah');
            $table->text('pesan')->nullable()->default('Jazakumullah Khairan Katsiran');
            
            $table->timestamps(); // Ini otomatis membuat created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('donasis');
    }
};