<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    //Le indico a laravel cual es la tabla que voy a trabajar
    protected $table = 'facultades';
    //Le indico a laravel cual es el nombre de la PK
    protected $primaryKey = 'id_facultad';
    //Le indico a laravel cuales son los campos que puedo modificar
    protected $fillable = [
        'facultad'
    ];

    public function grupos(){
        return $this->hasMany(Grupo::class,'id_facultad','id_facultad');
    }

}
