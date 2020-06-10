<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
// use Illuminate\Support\Facades\DB;

class Usuario extends Model 
{

public function userSesion()
{
    $user = Session::get('usuario');
    return $user;
}

public function userString()
{
    $user = Session::get('usuario');
    $value = Str::contains($user, '1');
    
    if ($value == TRUE) {

        return view('layouts.navbars.sidebar')->with('value', $value);
        # code...
    }
}

}