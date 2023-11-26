<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVakasiDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vakasi_detail', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_vakasi')->comment('Relasi Dengan id Pada Tabel Vakasi');
            $table->uuid('id_dsn')->comment('Relasi Dengan id Pada Tabel Dosen');
            $table->string('id_kls')->comment('ID Kelas Pada Tabel iRaise')->nullable();
            $table->string('kode_mk')->comment('Kode Mata Kuliah Pada Tabel iRaise')->nullable();
            $table->string('kd_prd')->comment('Kode Prodi Pada Tabel iRaise')->nullable();
            $table->integer('sks_mk')->comment('Jumlah Semester Mata Kuliah')->nullable();
            $table->string('kode_ruangan')->comment('Kode Ruangan Perkuliahan')->nullable();
            $table->integer('hari')->comment('Hari Tatap Muka Perkuliahan')->nullable();
            $table->string('lokal')->comment('Lokal Mahasiswa')->nullable();
            $table->integer('mhs')->comment('Jumlah Mahasiswa Perkuliahan')->nullable();
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
        Schema::dropIfExists('vakasi_detail');
    }
}
