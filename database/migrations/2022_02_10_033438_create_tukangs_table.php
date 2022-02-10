<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTukangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tukangs', function (Blueprint $table) {
            $table->id();
            $table->integer('biaya_harian')->nullable();
            $table->integer('biaya_lembur')->nullable();
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('tukangs');
    }
}
