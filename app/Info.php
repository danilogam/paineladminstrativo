<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    protected $fillable = ['scriptshead','scriptsfoot','googlemaps','facebook','instagram','twitter','youtube','telefone','email','endereco',];
}