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
        Schema::create('peliculas', function (Blueprint $table) {
            $table->id()->unique()->autoIncrement();
            $table->string('nombre');
            $table->text('sinopsis');
            $table->string('duracion');
            $table->text('clasificacion');
            $table->text('genero');
            $table->text('actores');
            $table->text('directores');
            $table->text('imagen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peliculas');
    }
};
