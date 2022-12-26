<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableKendaraanPart2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kendaraan', function(Blueprint $table) {
            $table->integer('status_unit')->nullable();
            $table->integer('status')->nullable();
            $table->integer('bbm')->nullable();
            $table->date('jadwal_service')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        Schema::table('kendaraan', function(Blueprint $table) {
            $table->dropColumn('status_unit');
            $table->dropColumn('status');
            $table->dropColumn('bbm');
            $table->dropColumn('jadwal_service');
        });
    }
}
