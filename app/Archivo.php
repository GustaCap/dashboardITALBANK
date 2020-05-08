<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{

    protected $table = 'archivos';

    // protected $fillable = ['id','files','cliente_id'];
    protected $fillable = [
        'id',
        'nombre',
        'apellido',
        'dni',
        'email',
        'p_cliente_id',
        'cliente_id',
        'tipo_cliente',
        'n_cuenta',
        'n_transfer',
        'name_archivo',
        'file',
        'fecha_emitido',
        'fecha_vence'
    ];

    // protected $connection = 'italdocv2';
    // protected $connection = 'italdocv3';
    protected $connection = 'italdocv6';

    /**Un achivo pertenece a un solo cliente */
    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }



}
