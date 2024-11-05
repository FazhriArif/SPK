<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNilaiToIntegerInNilaiKriteriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nilai_kriteria', function (Blueprint $table) {
            $table->dropColumn('nilai');
        });

        Schema::table('nilai_kriteria', function (Blueprint $table) {
            $table->integer('nilai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nilai_kriteria', function (Blueprint $table) {
            $table->dropColumn('nilai');
        });

        Schema::table('nilai_kriteria', function (Blueprint $table) {
            $table->decimal('nilai', 10, 2);
        });
    }
}
