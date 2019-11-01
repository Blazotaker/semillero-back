<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institucional extends Model
{
    protected $table = 'institucionales';
    protected $primaryKey = 'id_institucional';
    protected $fillable = [
        'nombre_institucional','id_semillero','id_periodo'
    ];
}
