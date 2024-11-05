<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKriteriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kriteria', function (Blueprint $table) {
            $table->id('id_kriteria'); // Primary key auto-increment
            $table->string('kode_kriteria')->unique(); // Unique column for kode_kriteria
            $table->string('nama_kriteria'); // Column for nama_kriteria
            $table->enum('atribut', ['benefit', 'cost']); // Enum column for atribut
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kriteria');
    }
}
