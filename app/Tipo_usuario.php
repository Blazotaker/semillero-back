<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_usuario extends Model
{
    protected $table = 'tipo_usuarios';
    protected $primaryKey = 'id_tipo_usuario';

    public function usuarios(){
        return $this->hasMany(Usuario::class,'id_tipo_usuario','id_tipo_usuario');
    }
    protected $fillable = [
        'rol'
    ];
}
