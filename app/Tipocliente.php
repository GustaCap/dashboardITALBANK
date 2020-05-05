<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipocliente extends Model
{

    protected $table = 'tipoclientes';

    protected $fillable = ['id','tipo'];

    // protected $connection = 'italdocv2';
    protected $connection = 'italdocv5';


    public function clientes()
    {
        return $this->hasMany('App\Cliente');
    }

    public function raices()
    {
        return $this->hasMany('App\Raiz');
    }



    // protected $primaryKey = 'id';
    // protected $connection = 'pgsql';



}