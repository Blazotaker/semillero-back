<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soporte extends Model
{
    protected $table = 'soportes';
    protected $primaryKey = 'id_soporte';
    protected $fillable = [
        'soporte', 'vinculo','id_producto'
    ];

    public function producto(){
        return $this->belongsTo(Producto::class,'id_producto','id_producto');
    }
}
