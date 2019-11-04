<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mes extends Model
{
    protected $table = 'meses';
    protected $primaryKey = 'id_mes';
    protected $fillable = [
        'mes'
    ];
}
