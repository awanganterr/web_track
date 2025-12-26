<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('surat_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_agenda')->nullable();
            $table->string('nomor_surat_asal');
            $table->date('tanggal_surat');
            $table->date('tanggal_diterima');
            $table->string('asal_surat');
            $table->string('perihal');
            $table->text('isi_ringkas')->nullable();
            $table->string('lampiran_file')->nullable();
            $table->string('status_disposisi')->default('pending');

            // Relasi
            $table->foreignId('kategori_id')->constrained('kategori_surats')->cascadeOnDelete();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('surat_masuks');
    }
};
