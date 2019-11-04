<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = 'actividades';
    protected $primaryKey = 'id_actividad';
    protected $fillable = [
        'actividad','responsable',
        'recursos','registro',
        'id_producto','estado','id_periodo'
    ];

    public function periodo(){
        return $this->belongsTo(Periodo::class,'id_periodo','id_periodo');
    }

}
