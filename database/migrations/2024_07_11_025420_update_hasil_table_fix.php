<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateHasilTableFix extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hasil', function (Blueprint $table) {
            // Drop the previous incorrect attempt to add columns
            $table->dropColumn(['nama_produk', 'alternatif_rekomendasi', 'tanggal_penyimpanan']);

            // Add the correct columns
            $table->string('nama_produk')->nullable();
            $table->text('rekomendasi_alternatif')->nullable();
            $table->timestamp('tanggal_penyimpanan')->nullable();
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
            // Revert back to the previous incorrect columns
            $table->string('nama_produk');
            $table->text('alternatif_rekomendasi');
            $table->timestamp('tanggal_penyimpanan');
            
            // Drop the newly added correct columns
            $table->dropColumn(['nama_produk', 'rekomendasi_alternatif', 'tanggal_penyimpanan']);
        });
    }
}
