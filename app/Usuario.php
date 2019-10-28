<?php

namespace App;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\Usuario  as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Authenticatable implements JWTSubject
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    protected $fillable = [
        'documento','nombre_usuario', 'apellido_usuario','email', 'telefono','estado','id_tipo_usuario','id_rol',
    ];


    public  function  getJWTIdentifier() {
		return  $this->getKey();
	}

	public  function  getJWTCustomClaims() {
		return [];
	}

    public function integrantes(){
        return $this->hasMany(Integrante::class,'id_usuario','id_usuario');
    }

    public function rol(){
        return $this->belongsTo(Rol::class, 'id_rol', 'id_rol');
    }

    public function tipo_usuario(){
        return $this->belongsTo(Tipo_usuario::class,'id_tipo_usuario','id_tipo_usuario');
    }




}
