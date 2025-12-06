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
        Schema::create('jadwal', function(Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            
            // Pegawai
            $table->unsignedBigInteger('pegawai_id');
            $table->foreign('pegawai_id')->references('id')->on('pegawai')->cascadeOnDelete()->cascadeOnUpdate();

            // Shift
            $table->unsignedBigInteger('shift_id');
            $table->foreign('shift_id')->references('id')->on('shift')->cascadeOnDelete()->cascadeOnUpdate();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('jadwal');
        Schema::enableForeignKeyConstraints();
    }
};
