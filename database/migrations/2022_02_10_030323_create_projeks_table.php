<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjeksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projeks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_projek', 100)->nullable();
            $table->enum('status', array('closing', 'process'))->nullable();
            $table->unsignedBigInteger('pm')->nullable();
            $table->unsignedBigInteger('marketing')->nullable();
            $table->unsignedBigInteger('supervisor')->nullable();
            $table->string('rencana_kerja', 30)->nullable();
            $table->string('lokasi', 50)->nullable();
            $table->string('owner', 50)->nullable();
            $table->string('tanggal_mulai', 50)->nullable();
            $table->string('tanggal_selesai', 50)->nullable();
            $table->integer('total_volume_rencana')->nullable();
            $table->integer('total_volume_sebelumnya')->nullable();
            $table->integer('total_volume_hari_ini')->nullable();
            $table->integer('total_volume_opname')->nullable();
            $table->integer('total_harga_satuan')->nullable();
            $table->integer('total_opname')->nullable();
            $table->integer('total_persentase')->nullable();
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
        Schema::dropIfExists('projeks');
    }
}
