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
            $table->string('carpetaRaiz');
            $table->string('nivelRelacion');
            $table->string('fecExpiracion');
            $table->integer('tipocliente_id');
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
