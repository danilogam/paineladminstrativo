<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;

	/* Array de campos protegidos a serem gravados no banco. Ao usar [body] ele aceitará TODOS os campos. */
    protected $fillable = ['title', 'content', 'image', 'status', 'gallery_id', 'categoria_id', 'description', 'keywords'];

    /* Função para adicionar a URL do site automaticamente na imagem após puxar do banco
    URL determinada no .env */
    public function getImageAttribute($value) {
        if($value) {
            return config('app.url').'uploads/'.$value;
        }
    }

    /* Atribuir POST a uma CATEGORIA. (Posts são pertencentes a uma categoria - belongsTo) */
    public function categoria(){
        return $this->belongsTo('App\Categoria');
    }

    /* Atribuir POST a uma CATEGORIA. (Posts são pertencentes a uma categoria - belongsTo) */
    public function galeria(){
        return $this->belongsTo('App\Galeria','');
    }

    /* Cria o slug do título da postagem*/
    public function sluggable()
    {
        return [
            'slug' => [
                'source'=>'title'
            ]
        ];
    }
}
