<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
	/* Array de campos protegidos a serem gravados no banco. Ao usar [body] ele aceitará TODOS os campos. */
    protected $fillable = ['name'];

    /* Atribuir GALERIA a várias MEDIAS. (Galerias possuem várias Medias - hasManye) */
    public function medias() {
    	return $this->hasMany('App\Media');
    }
}
