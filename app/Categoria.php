<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
	/* Array de campos protegidos a serem gravados no banco. Ao usar [body] ele aceitará TODOS os campos. */
    protected $fillable = ['label'];
}