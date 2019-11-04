<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    protected $fillable = [
        'id_tipo_producto','producto',
        'id_soporte', 'id_proyecto',
        'id_actividad'
    ];


    public function tipo_producto(){
        return $this->belongsTo(Tipo_producto::class,'id_tipo_producto','id_tipo_producto');
    }
}
