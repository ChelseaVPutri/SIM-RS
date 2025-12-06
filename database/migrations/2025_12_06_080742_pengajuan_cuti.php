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
        Schema::create('pengajuan_cuti', function (Blueprint $table) {
            $table->id();

            // Pegawai
            $table->foreignId('pegawai_id')->constrained('pegawai');

            $table->enum('jenis_cuti', ['Cuti sakit',  'Cuti tahunan',]);
            $table->date('tanggal_mulai_cuti');
            $table->date('tanggal_selesai_cuti');
            $table->text('alasan_cuti');
            $table->string('foto_surat_dokter')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
