<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $table = 'periodos';
    protected $primaryKey = 'id_periodo';
    protected $fillable = [
        'periodo'
    ];

    public function integrantes(){
        return $this->hasMany(Integrante::class,'id_periodo','id_periodo');
    }

    public function actividades(){
        return $this->hasMany(Actividad::class,'id_periodo','id_periodo');
    }

    public function proyectos(){
        return $this->hasMany(Proyecto::class,'id_periodo','id_periodo');
    }

    public function proyectos_grado(){
        return $this->hasMany(Proyecto_grado::class,'id_periodo','id_periodo');
    }

    public function institucionales(){
        return $this->hasMany(Institucional::class,'id_periodo','id_periodo');
    }

    public function coordinador(){
        return $this->hasOne(Coordinador::class,'id_periodo','id_periodo');
    }

}

