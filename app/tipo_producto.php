<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_producto extends Model
{
    protected $table = 'tipo_productos';
    protected $primaryKey = 'id_tipo_producto';

    protected $fillable = [
        'tipo_producto'
    ];
}
