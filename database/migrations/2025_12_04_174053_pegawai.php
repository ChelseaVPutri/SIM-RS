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
        Schema::create("pegawai", function (Blueprint $table) {
            $table->id();
            $table->string("nama_lengkap");
            $table->string("nip")->index();
            $table->string('nomor_telepon');

            // Departmet
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('department')->cascadeOnDelete()->cascadeOnUpdate();

            $table->integer('sisa_cuti');
            $table->enum('status', ['Aktif', 'Cuti']);
            $table->enum('role', ['manajer', 'user']);
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists("pegawai");
        Schema::enableForeignKeyConstraints();
    }
};
