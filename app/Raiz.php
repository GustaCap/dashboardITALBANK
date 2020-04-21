<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raiz extends Model
{

    protected $table = 'raices';

    protected $fillable = ['id','carpetaRaiz','nivelRelacion','fecExpiracion','tipocliente_id'];

    // protected $connection = 'italdocv2';
    // protected $connection = 'italdocv3';
    protected $connection = 'italdocv5';


    public function tipoclientes()
    {
        return $this->hasMany('App\Tipocliente');
    }



}
