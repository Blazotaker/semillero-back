<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soporte extends Model
{
    protected $table = 'soportes';
    protected $primaryKey = 'id_soporte';
    protected $fillable = [
        'vinculo'
    ];
}
