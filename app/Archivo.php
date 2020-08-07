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
        'cliente_id_itbk',
        'tipo_cliente',
        'n_cuenta',
        'n_transfer',
        'name_archivo',
        'file',
        'fecha_emitido',
        'fecha_vence',
        'raiz_id',      //Agregado 11/05/2020 para pruebas
        'estatus_doc',  //Agregado 02/06/2020 para pruebas
        'usuario',              //Agregado el 08/06/2020 para cargar nombre del usuario...
        'via_payment',
        'channel',
        'cuenta_bene',
        'nombre_bene',
        'banco_bene',
        'proposito'
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
