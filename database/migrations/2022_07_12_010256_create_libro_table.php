<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('autor',100);
            $table->string('titulo',120);
            $table->string('edicion',60);
            $table->string('datos_publicacion',200);
            $table->string('tipo_contenido',100);
            $table->string('restricciones',100);
            $table->string('materia',100);
            $table->string('proveedor',80);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('libro');
    }
}
