<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semillero extends Model
{
    protected $table = 'semilleros';
    protected $primaryKey = 'id_grupo';
    protected $fillable = [
        'semillero', 'objetivo', 'descripcion','id_grupo'
    ];

    public function grupo(){
        return $this->belongsTo(Grupo::class,'id_grupo','id_grupo');
    }

    public function integrantes(){
        return $this->hasMany(Integrante::class,'id_semillero','id_semillero');
    }
}
