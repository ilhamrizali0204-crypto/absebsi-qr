<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('akun_siswa', function (Blueprint $table) {
            $table->id();
        
            $table->unsignedBigInteger('siswa_id');
        
            $table->string('username')->unique();
            $table->string('password');
            $table->string('password_plain'); // untuk admin
            $table->string('kelas');
        
            $table->timestamps();
        
            $table->foreign('siswa_id')
                ->references('id')
                ->on('siswas') // ⬅️ PENTING
                ->onDelete('cascade');
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('akun_siswa');
    }
};

