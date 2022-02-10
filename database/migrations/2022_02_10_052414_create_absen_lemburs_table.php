<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsenLembursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absen_lemburs', function (Blueprint $table) {
            $table->id();
            $table->string('lokasi', 150)->nullable();
            $table->string('ttd', 50)->nullable();
            $table->string('jam_datang', 20)->nullable();
            $table->string('jam_pulang', 20)->nullable();
            $table->string('tanggal', 15)->nullable();
            $table->string('hari', 15)->nullable();
            $table->string('bulan', 20)->nullable();
            $table->string('tahun', 10)->nullable();
            $table->string('keterangan', 10)->nullable();
            $table->string('foto', 50)->nullable();
            $table->enum('validasi', array('yes', 'no'))->nullable();
            $table->string('jam_validasi', 20)->nullable();
            $table->string('status', 20)->nullable();
            $table->unsignedBigInteger('projek_id');
            $table->unsignedBigInteger('absen_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tukang_id');
            $table->unsignedBigInteger('edit_by');
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
        Schema::dropIfExists('absen_lemburs');
    }
}
