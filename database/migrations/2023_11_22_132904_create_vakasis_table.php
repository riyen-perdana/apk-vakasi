<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVakasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vakasi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('id_smt')->comment('Relasi dengan tabel Semester')->unique();
            $table->string('nip_dkn')->comment('Nomor Induk Pegawai Dekan Menjabat')->nullable();
            $table->string('nm_dkn')->comment('Nama Dekan Menjabat')->nullable();
            $table->string('nip_ppk')->comment('Nomor Induk Pegawai PPK')->nullable();
            $table->string('nm_ppk')->comment('Nama PPK')->nullable();
            $table->string('nip_bp')->comment('Nomor Induk Pegawai Bendahara Pengeluaran')->nullable();
            $table->string('nm_bp')->comment('Nama Bendahara Pengeluaran')->nullable();
            $table->string('nip_ppk_rm')->comment('Nomor Induk Pegawai PPK RM')->nullable();
            $table->string('nm_ppk_rm')->comment('Nama PPK RM')->nullable();
            $table->string('nip_bpp_rm')->comment('Nomor Induk Pegawai BPP RM')->nullable();
            $table->string('nm_bpp_rm')->comment('Nama BPP RM')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vakasi');
    }
}
