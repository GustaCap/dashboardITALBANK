<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipocliente extends Model
{

    protected $table = 'tipoclientes';

    protected $fillable = [
        'id',
        'tipo',
        'usuario',
        'estatus'];

    // protected $connection = 'italdocv2';
    protected $connection = 'italdocv6';


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
