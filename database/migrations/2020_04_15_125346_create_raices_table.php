<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raices', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('tipocliente_id');
            $table->string('carpeta_raiz');
            $table->string('nivel_relacion');
            $table->string('requerido');
            $table->string('frecuencia');
            $table->string('fec_expiracion');
            $table->string('nombre_doc');
            $table->string('nivel');
            $table->string('tipo_carpeta');
            $table->string('estatus');
            $table->string('usuario');
            $table->foreign('tipocliente_id')->references('id')->on('tipoclientes')->onDelete('cascade');
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
        Schema::dropIfExists('raices');
    }
}
