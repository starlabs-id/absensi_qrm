<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailProjeksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_projeks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('projeck_id')->nullable();
            $table->string('tanggal', 20)->nullable();
            $table->string('foto_1', 50)->nullable();
            $table->string('foto_2', 50)->nullable();
            $table->string('foto_3', 50)->nullable();
            $table->string('foto_4', 50)->nullable();
            $table->string('foto_5', 50)->nullable();
            $table->string('foto_6', 50)->nullable();
            $table->string('foto_7', 50)->nullable();
            $table->string('foto_8', 50)->nullable();
            $table->string('foto_9', 50)->nullable();
            $table->string('foto_10', 50)->nullable();
            $table->text('keterangan')->nullable();
            $table->text('uraian_pekerjaan')->nullable();
            $table->integer('volume_rencana')->nullable();
            $table->integer('volume_sebelumnya')->nullable();
            $table->integer('volume_hari_ini')->nullable();
            $table->integer('volume_opname')->nullable();
            $table->integer('harga_satuan')->nullable();
            $table->integer('opname_hari_ini')->nullable();
            $table->integer('total_opname_hari_ini')->nullable();
            $table->integer('persentase')->nullable();
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
        Schema::dropIfExists('detail_projeks');
    }
}
