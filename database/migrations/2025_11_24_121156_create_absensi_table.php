<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();

            // RELASI KE TABEL siswas
            $table->foreignId('siswa_id')
                  ->constrained('siswas') // <-- PENTING: 'siswas'
                  ->onDelete('cascade');

            $table->date('tanggal');
            $table->enum('status', ['H', 'S', 'I', 'A'])->default('H');
            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
