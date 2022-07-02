<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'image', 'role_id', 'status', 'username'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /* Função para adicionar a URL do site automaticamente na imagem após puxar do banco
    URL determinada no .env */
    public function getImageAttribute($value) {
        if($value) {
            return config('app.url').'uploads/'.$value;
        }
    }

    /* Atribuir USUÁRIO a uma ROLE. (Usuários são pertencentes a uma role - belongsTo) */
    public function role(){
        return $this->belongsTo('App\Role');
    }

    /* Verificar e validar tipo do usuário */
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles);
        }

        return $this->hasRole($roles);
    }

    /* Verificação de múltiplas roles */
    public function hasAnyRole($roles)
    {
        return null !== $this->role()->whereIn('id', $roles)->first();
    }

    /* Verificação role única */
    public function hasRole($role)
    {
        return null !== $this->role()->where('id', $role)->first();
    }

    /* Verificação o tipo de usuário */
    public function isAdmin() {
        if($this->role->label == 'Administrador') {
            return true;
        }

        return false;
    }

    public function isEditor() {
        if($this->role->label == 'Editor') {
            return true;
        }

        return false;
    }

    public function isRedator() {
        if($this->id == Auth::user()->id) {
            return true;
        }

        return false;
    }
}
