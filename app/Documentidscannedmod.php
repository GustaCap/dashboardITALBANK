<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documentidscannedmod extends Model
{

    protected $table = 'documentidscannedmod';

    protected $fillable = ['id','mod','documentid','path','expdate','uploaddate','username','active','deleted', 'id_doc'];

    protected $connection = 'italsis';


}
