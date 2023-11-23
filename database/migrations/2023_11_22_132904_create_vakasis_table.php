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
            $table->string('id_smt')->comment('Relasi dengan tabel Semester');
            $table->text('data')->comment('Data Vakasi Dari iRaise');
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
