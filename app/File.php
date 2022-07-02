<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
	/* Array de campos protegidos a serem gravados no banco. Ao usar [body] ele aceitará TODOS os campos. */
    protected $fillable = ['file', 'galeria_id'];

    /* Função para adicionar a URL do site automaticamente na imagem após puxar do banco
    URL determinada no .env */
    public function getFileAttribute($value) {
            return config('app.url').'uploads/'.$value;
    }

    /* Atribuir MEDIAS a uma GALERIA. (MEDIAS pertencem a uma GALERIA - belongsTo) */
    public function galeria(){
        return $this->belongsTo('App\Galeria');
    }
}