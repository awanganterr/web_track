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
        if (!Schema::hasColumn('surat_masuks', 'status')) {
            Schema::table('surat_masuks', function (Blueprint $table) {
                $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('isi_ringkas');
            });
        }

        if (!Schema::hasColumn('surat_keluars', 'status')) {
            Schema::table('surat_keluars', function (Blueprint $table) {
                $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('isi_ringkas');
            });
        }

        if (!Schema::hasColumn('agenda_kegiatans', 'status')) {
            Schema::table('agenda_kegiatans', function (Blueprint $table) {
                $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('keterangan');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('surat_masuks', 'status')) {
            Schema::table('surat_masuks', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }

        if (Schema::hasColumn('surat_keluars', 'status')) {
            Schema::table('surat_keluars', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }

        if (Schema::hasColumn('agenda_kegiatans', 'status')) {
            Schema::table('agenda_kegiatans', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }
    }
};
