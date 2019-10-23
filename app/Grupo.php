<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = 'grupos';
    protected $primaryKey = 'id_grupo';
    protected $fillable = [
        'grupo', 'categoria', 'cod_colciencias','id_facultad'
    ];
    public function facultad(){
        return $this->belongsTo(Facultad::class,'id_facultad','id_facultad');
    }

    public function coordinador(){
        return $this->hasOne(Coordinador::class,'id_grupo','id_grupo');
    }
}
