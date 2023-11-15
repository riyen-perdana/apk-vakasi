<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerangkatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perangkat', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nip',18)->comment('Nomor Induk Pegawai Perangkat');
            $table->string('nama')->comment('Nama perangkat');
            $table->string('glr_dpn')->comment('Gelar Depan Perangkat')->nullable();
            $table->string('glr_blk')->comment('Gelar perangkat')->nullable();
            $table->enum('is_jabatan',['Dekan','Bendahara Pengeluaran','Pejabat Pembuat Komitmen','BPP Rupiah Murni', 'PPK RM'])->comment('Jabatan Perangkat')->nullable();
            $table->enum('is_plt',['Y','N'])->comment('Apakah Status Perangkat Plt ?')->nullable();
            $table->enum('is_aktif',['Y','N'])->comment('Apakah Status Perangkat Aktif ?')->nullable();
            $table->date('awal_jabatan')->comment('Awal Perangkat Menjabat');
            $table->date('akhir_jabatan')->comment('Akhir Perangkat Menjabat');
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
        Schema::dropIfExists('perangkat');
    }
}
