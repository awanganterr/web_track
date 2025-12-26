<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('agenda_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan');
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai')->nullable();
            $table->string('tempat')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('status')->default('scheduled');

            // Relasi
            $table->foreignId('jenis_agenda_id')->constrained('jenis_agendas')->cascadeOnDelete();
            $table->foreignId('surat_masuk_id')->nullable()->constrained('surat_masuks')->cascadeOnDelete();
            $table->foreignId('surat_keluar_id')->nullable()->constrained('surat_keluars')->cascadeOnDelete();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('agenda_kegiatans');
    }
};
