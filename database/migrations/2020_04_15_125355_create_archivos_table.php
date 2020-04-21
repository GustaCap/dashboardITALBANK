<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('cliente_id')->nullable();
            $table->string('tipoCliente')->nullable();
            $table->string('numCuenta')->nullable();
            $table->string('numTransfer')->nullable();
            $table->string('nombreArchivo')->nullable();
            $table->string('file');
            $table->date('fecEmitido')->nullable();
            $table->date('fecExpira')->nullable();
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
        Schema::dropIfExists('archivos');
    }
}
