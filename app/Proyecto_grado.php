<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto_grado extends Model
{
    protected $table = 'proyecto_grados';
    protected $primaryKey = 'id_proyecto_grado';
    protected $fillable = [
        'proyecto_grado','id_semillero','id_periodo'
    ];
}
