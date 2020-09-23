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
            $table->integer('cliente_id')->nullable(); //cambio realizado de not null a null para funcionalidad del api. fecha:08/06/2020
            $table->integer('raiz_id')->nullable();
            $table->string('precliente_id')->nullable();     /**Cliente pospecto: No es cliente del banco y no posee numero de cuenta asignada. DATA API */
            $table->string('cliente_id_itbk')->nullable();       /**Cliente del banco */
            $table->string('tipo_cliente')->nullable();
            $table->string('n_cuenta')->nullable();
            $table->string('n_transfer')->nullable();
            $table->string('name_archivo')->nullable();
            $table->string('file');
            $table->date('fecha_emitido')->nullable();
            $table->date('fecha_vence')->nullable();
            $table->string('via_payment')->nullable();
            $table->string('channel')->nullable();
            $table->string('cuenta_bene')->nullable();
            $table->string('nombre_bene')->nullable();
            $table->string('banco_bene')->nullable();
            $table->string('proposito')->nullable();
            $table->string('nivel_relacion')->nullable();
            $table->string('estatus_doc')->nullable();
            $table->string('usuario')->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
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
