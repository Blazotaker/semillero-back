<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Integrante extends Model
{
    protected $table = 'integrantes';
    protected $primaryKey = 'id_integrante';
    protected $fillable = [
        'id_usuario', 'id_tipo_integrante','id_periodo'
    ];

    public function usuario(){
        return $this->belongsTo(Usuario::class,'id_usuario','id_usuario');
    }

    public function semillero(){
        return $this->belongsTo(Semillero::class,'id_semillero','id_semillero');
    }

    public function periodo(){
        return $this->belongsTo(Periodo::class,'id_periodo','id_periodo');
    }
}
