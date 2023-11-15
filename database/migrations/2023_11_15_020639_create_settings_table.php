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
            $table->integer('koreksi')->comment('Besaran Amprah Pengoreksi Soal')->nullable();
            $table->integer('soal')->comment('Besaran Amprah Pembuatan Soal')->nullable();
            $table->integer('mengawas')->comment('Besaran Amprah Mengawas')->nullable();
            $table->integer('pph_21')->comment('Besaran Pajak')->nullable();
            $table->enum('is_aktif',['Y','N'])->comment('Apakah Setting Aktif')->default('Y')->nullable();
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
