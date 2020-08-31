<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asociacion extends Model
{

    protected $table = 'asociaciones';

    protected $fillable = [
        'id',
        'raiz_id',
        'cliente_id_itbk',
        'n_cuenta',
        'tipocliente_id',
        'carpeta_raiz'
    ];

    protected $connection = 'italdocv6';



}
