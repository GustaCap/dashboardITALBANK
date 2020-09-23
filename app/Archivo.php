<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{

    protected $table = 'archivos';

    // protected $fillable = ['id','files','cliente_id'];
    protected $fillable = [
        'id',
        'cliente_id',
        'raiz_id',
        'precliente_id',
        'cliente_id_itbk',
        'tipo_cliente',
        'n_cuenta',
        'n_transfer',
        'name_archivo',
        'file',
        'fecha_emitido',
        'fecha_vence',
        'via_payment',
        'channel',
        'cuenta_bene',
        'nombre_bene',
        'banco_bene',
        'proposito',
        'nivel_relacion', //agregado 17/08/2020 para pruebas
        'estatus_doc',
        'usuario'
    ];


    protected $connection = 'italdocv6';

    /**Un achivo pertenece a un solo cliente */
    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }



}
