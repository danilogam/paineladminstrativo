<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{	
	protected $fillable = ['nome','estado_id'];

    /* Atribuir CIDADE a um ESTADO. */
    public function estado(){
        return $this->belongsTo('App\Estado');
    }
}