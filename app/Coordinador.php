<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordinador extends Model
{
    protected $table = 'coordinadores';
    protected $primaryKey = 'id_coordinador';
    protected $fillable = [
        'id_usuario','id_semillero'
    ];

    public function coordinador(){
        return $this->belongsTo('semilleros','id_semillero','id_semillero');
    }
}
