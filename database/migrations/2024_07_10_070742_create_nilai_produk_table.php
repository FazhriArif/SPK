<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_produk', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->integer('c01');
            $table->integer('c02');
            $table->integer('c03');
            $table->integer('c04');
            $table->integer('c05');
            $table->integer('c06');
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
        Schema::dropIfExists('nilai_produk');
    }
}
