<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateHasilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hasil', function (Blueprint $table) {
            if (!Schema::hasColumn('hasil', 'nama_produk')) {
                $table->string('nama_produk')->nullable();
            }
            if (!Schema::hasColumn('hasil', 'rekomendasi_alternatif')) {
                $table->text('rekomendasi_alternatif')->nullable();
            }
            if (!Schema::hasColumn('hasil', 'tanggal_penyimpanan')) {
                $table->timestamp('tanggal_penyimpanan')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hasil', function (Blueprint $table) {
            if (Schema::hasColumn('hasil', 'nama_produk')) {
                $table->dropColumn('nama_produk');
            }
            if (Schema::hasColumn('hasil', 'rekomendasi_alternatif')) {
                $table->dropColumn('rekomendasi_alternatif');
            }
            if (Schema::hasColumn('hasil', 'tanggal_penyimpanan')) {
                $table->dropColumn('tanggal_penyimpanan');
            }
        });
    }
}
