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
            $table->unsignedBigInteger('pegawai_id');
            $table->foreign('pegawai_id')->references('id')->on('pegawai')->cascadeOnDelete()->cascadeOnUpdate();

            $table->enum('jenis_cuti', ['Cuti sakit',  'Cuti tahunan',]);
            $table->date('tanggal_mulai_cuti');
            $table->date('tanggal_selesai_cuti');
            $table->text('alasan_cuti');
            $table->string('foto_bukti')->nullable();
            $table->enum('status', ['Disetujui', 'Pending', 'Ditolak']);
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('pengajuan_cuti');
        Schema::enableForeignKeyConstraints();

    }
};
