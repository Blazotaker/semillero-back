<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    protected $fillable = [
        'id_usuario', 'documento','nombre_usuario', 'apellido_usuario','email ', 'telefono','id_tipo_usuario','id_rol',
    ];

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
