<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id_rol';
    protected $fillable = ['rol'];

    public function usuarios(){
        return $this->hasMany(Usuario::class,'id_rol','id_rol');
    }
}
