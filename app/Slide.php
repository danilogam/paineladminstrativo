<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
	/* Array de campos protegidos a serem gravados no banco. Ao usar [body] ele aceitará TODOS os campos. */
    protected $fillable = ['status','image','title','summary','button','url','target'];

    /* Função para adicionar a URL do site automaticamente na imagem após puxar do banco
    URL determinada no .env */
    public function getImageAttribute($value) {
        if($value) {
            return config('app.url').'uploads/'.$value;
        }
    }
}
