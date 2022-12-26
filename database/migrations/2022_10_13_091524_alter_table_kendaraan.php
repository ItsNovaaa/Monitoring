<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableKendaraan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kendaraan', function(Blueprint $table) {
            $table->integer('sewa')->nullable()->after('tipe_kendaraan');
            $table->double('biaya', 16, 2)->nullable()->after('sewa');
            $table->date('dari_tanggal')->nullable()->after('biaya');
            $table->date('sampai_tanggal')->nullable()->after('dari_tanggal');
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
            $table->dropColumn('sewa');
            $table->dropColumn('biaya');
            $table->dropColumn('dari_tanggal');
            $table->dropColumn('sampai_tanggal');
        });
    }
}
