<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = 'actividades';
    protected $primaryKey ='id_actividad';
    protected $fillable =['actividad',
    'id_semillero','id_periodo',
    'mes','responsable',
    'recursos',
    'registro','responsable',
    'producto','estado'
    ];

    public function semillero(){
        return $this->belongsTo(Semillero::class,'id_semillero','id_semillero');
    }

    public function periodo(){
        return $this->belongsTo(Periodo::class,'id_periodo','id_periodo');
    }

}
