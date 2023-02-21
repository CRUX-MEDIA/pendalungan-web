<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_penyewaan', function (Blueprint $table) {
            $table->id('id_riwayat_penyewaan');
            $table->unsignedBigInteger('id_pelanggan');
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->string('no_sewa', 50);
            $table->dateTime('tgl_sewa');
            $table->dateTime('tgl_kembali');
            $table->integer('total');
            $table->integer('pajak');
            $table->integer('dibayar');
            $table->unsignedBigInteger('id_status_sewa');
            $table->foreign('id_status_sewa')->references('id_status_sewa')->on('status_sewa');
            $table->unsignedBigInteger('id_jaminan');
            $table->foreign('id_jaminan')->references('id_jaminan')->on('jaminan');
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
        Schema::dropIfExists('riwayat_penyewaan');
    }
};