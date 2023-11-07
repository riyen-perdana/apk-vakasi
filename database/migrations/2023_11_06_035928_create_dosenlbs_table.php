<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenlbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosenlb', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nup_nidn')->comment('Nomor Urut Pendidik atau NIDN')->unique();
            $table->string('glr_dpn')->comment('Gelar Depan')->nullable();
            $table->string('glr_blk')->comment('Gelar Belakang')->nullable();
            $table->string('name')->comment('Nama Dosen');
            $table->string('npwp')->comment('Nomor Pokok Wajib Pajak');
            $table->string('no_rek')->comment('Nomor Rekening');
            $table->string('name_no_rek')->comment('Nama Sesuai Rekening');
            $table->uuid('pangkat')->comment('ID Pangkat Dosen');
            $table->uuid('fungsional')->comment('ID Fungsional Dosen');
            $table->enum('is_aktif',['Y','N'])->comment('Apakah Dosen Aktif')->default('Y');
            $table->string('no_telp')->comment('Nomor HP atau Telepon Dosen')->nullable();
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
        Schema::dropIfExists('dosenlb');
    }
}
