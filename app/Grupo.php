<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = 'grupos';
    protected $primaryKey = 'id_grupo';
    protected $fillable = [
        'grupo', 'id_categoria',
        'cod_colciencias','id_facultad',
        'vinculo','siglas'
    ];
    public function facultad(){
        return $this->belongsTo(Facultad::class,'id_facultad','id_facultad');
    }

    public function director(){
        return $this->hasOne(Director::class,'id_grupo','id_grupo');
    }
}
