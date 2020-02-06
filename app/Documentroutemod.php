<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documentroutemod extends Model
{
    protected $table = 'dolgram.documentroutemod';

    protected $fillable = ['id','mod','path','spath','orderrep','active','deleted','id_tipo_doc'];

    protected $connection = 'italsis';
    //
}
