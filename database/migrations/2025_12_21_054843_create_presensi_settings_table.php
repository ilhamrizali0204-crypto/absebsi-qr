<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('presensi_settings', function (Blueprint $table) {
        $table->id();

        $table->boolean('aktif')->default(false);
        $table->enum('mode', ['scan', 'mandiri'])->nullable();

        $table->time('jam_mulai')->nullable();
        $table->time('jam_selesai')->nullable();

        $table->string('token')->nullable(); // buat QR

        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('presensi_settings');
}

};
