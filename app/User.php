<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     *
     */
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    protected $fillable = [
        'documento','nombre_usuario', 'apellido_usuario','email', 'telefono','estado','id_tipo_usuario','id_rol',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    public  function  getJWTIdentifier() {
		return  $this->getKey();
	}

	public  function  getJWTCustomClaims() {
		return [];
	}
}
