<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRequestKendaraan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_kendaraan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_kendaraan');
            $table->integer('id_pegawai');
            $table->string('tujuan_pemesanan');
            $table->string('status');
            $table->integer('id_approval')->nullable();
            $table->string('created_by');
            $table->timestamp('created_at');
            $table->string('updated_by')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_kendaraan');
    }
}
