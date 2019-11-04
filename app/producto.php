<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    protected $fillable = [
        'producto','id_tipo_producto',
        'id_actividad','id_soporte',
        'id_proyecto'
    ];
}
