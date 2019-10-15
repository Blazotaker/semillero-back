<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $table = 'periodos';
    protected $primaryKey = 'id_periodo';
    protected $fillable = [
        'periodo'
    ];

    public function integrantes(){
        return $this->hasMany(Integrante::class,'id_periodo','id_periodo');
    }
    


}

