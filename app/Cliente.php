<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'id',
        'nombre',
        'apellido',
        'dni',
        'email',
        'cliente_id_itbk', /**id de cliente italbank */
        'tipocliente_id',
        'n_cuenta'
    ];

    protected $connection = 'italdocv5';

    /**Un cliente solo tiene un tipo de cliente */
    public function tipocliente()
    {
        return $this->belongsTo('App\Tipocliente');
    }

    /**Un cliente tiene muchos Archivos */
    public function archivos()
    {
        return $this->hasMany('App\Archivo');
    }
}
