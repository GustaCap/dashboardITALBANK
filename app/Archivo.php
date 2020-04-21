<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{

    protected $table = 'archivos';

    // protected $fillable = ['id','files','cliente_id'];
    protected $fillable = ['id','cliente_id','tipo_cliente','num_cuenta','num_transfer','nombre_archivo','file','fec_emitido','fec_expira'];

    // protected $connection = 'italdocv2';
    // protected $connection = 'italdocv3';
    protected $connection = 'italdocv5';



}
