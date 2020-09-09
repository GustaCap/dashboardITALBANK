<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raiz extends Model
{

    protected $table = 'raices';

    protected $fillable = [
        'id',
        'carpeta_raiz',
        'tipocliente_id',
        'nivel_relacion',
        'requerido',
        'frecuencia',
        'fec_expiracion',
        //agregados
         'nombre_doc',
         'nivel',
         'tipo_carpeta',
         'estatus'

    ];

    // protected $connection = 'italdocv2';
    // protected $connection = 'italdocv3';
    protected $connection = 'italdocv6';


    public function tipocliente()
    {
        return $this->belongsTo('App\Tipocliente');
    }

    public function asociacion()
    {
        return $this->belongsTo('App\Asociacion');
    }



}
