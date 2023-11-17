<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('fungsional')->comment('Kode Jenis Jabatan Fungsional')->nullable();
            $table->integer('a_ajr')->comment('Besaran Amprah Mengajar')->nullable();
            $table->integer('a_soal')->comment('Besaran Amprah Membuat Soal')->nullable();
            $table->integer('a_aws')->comment('Besaran Amprah Mengawas')->nullable();
            $table->integer('a_krk')->comment('Besaram Amprah Mengoreksi')->nullable();
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
        Schema::dropIfExists('setting');
    }
}
