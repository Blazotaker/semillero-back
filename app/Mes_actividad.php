<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mes_actividad extends Model
{
    protected $table = 'mes_actividades';
    protected $primaryKey = 'id_mes_actividad';
    protected $fillable = [
        'id_actividad','id_mes'
    ];
}
