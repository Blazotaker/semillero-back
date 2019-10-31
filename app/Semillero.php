<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semillero extends Model
{
    protected $table = 'semilleros';
    protected $primaryKey = 'id_semillero';
    protected $fillable = [
        'semillero', 'objetivo', 'descripcion','id_grupo'
    ];

    public function grupo(){
        return $this->belongsTo(Grupo::class,'id_grupo','id_grupo');
    }

    public function integrantes(){
        return $this->hasMany(Integrante::class,'id_semillero','id_semillero');
    }

    public function actividades(){
        return $this->hasMany(Actividad::class,'id_semillero','id_semillero');
    }

    public function proyectos(){
        return $this->hasMany(Proyecto::class,'id_semillero','id_semillero');
    }

    public function proyectos_grado(){
        return $this->hasMany(Proyecto_grado::class,'id_semillero','id_semillero');
    }

    public function institucionales(){
        return $this->hasMany(Institucional::class,'id_semillero','id_semillero');
    }

    public function coordinador(){
        return $this->hasOne(Coordinador::class,'id_semillero','id_semillero');
    }

}
