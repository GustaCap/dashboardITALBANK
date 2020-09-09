<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsociacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asociaciones', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('raiz_id');
            $table->string('cliente_id_itbk');
            $table->string('n_cuenta');
            $table->string('tipocliente_id');
            $table->string('usuario');
            $table->string('carpeta_raiz');
            $table->string('estatus');
            $table->foreign('raiz_id')->references('id')->on('raices')->onDelete('cascade');
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
        Schema::dropIfExists('tipoclientes');
    }
}
