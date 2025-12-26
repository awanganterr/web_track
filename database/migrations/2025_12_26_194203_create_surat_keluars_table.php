<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('surat_keluars', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_agenda')->nullable();
            $table->string('nomor_surat');
            $table->date('tanggal_surat');
            $table->string('tujuan_surat');
            $table->string('perihal');
            $table->text('isi_ringkas')->nullable();
            $table->string('lampiran_file')->nullable();
            $table->string('status')->default('draft');

            // Relasi
            $table->foreignId('kategori_id')->constrained('kategori_surats')->cascadeOnDelete();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('surat_keluars');
    }
};
