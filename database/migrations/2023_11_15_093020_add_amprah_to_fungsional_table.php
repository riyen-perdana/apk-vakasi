<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAmprahToFungsionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fungsional', function (Blueprint $table) {
            $table->integer('amprah')->comment('Besar Amprah Mengajar')->nullable()->after('jbtn_fungsional');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fungsional', function (Blueprint $table) {
            $table->dropColumn('amprah');
        });
    }
}
