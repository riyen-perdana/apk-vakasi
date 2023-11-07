<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code_red',30)->comment('Hashing Code')->unique();
            $table->string('nip',18)->comment('Nomor Induk Pegawai')->unique();
            $table->string('glr_dpn')->comment('Gelar Depan')->nullable();
            $table->string('glr_blk')->comment('Gelar Belakang')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('is_aktif',['Y','N'])->comment('Apakah Aktif ?')->default('Y');
            $table->string('avatar')->comment('Foto Pengguna')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
