<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $table = 'periodos';
    protected $primaryKey = 'id_periodo';
    protected $fillable = [
        'periodo','fecha_inicio','fecha_fin','id_semillero'
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
    public function coordinador(){
        return $this->hasOne(Coordinador::class,'id_periodo','id_periodo');
    }

}

