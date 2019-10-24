<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    protected $table = 'directores';
    protected $primaryKey = 'id_director';
    protected $fillable = [
        'id_usuario','id_grupo'
    ];


    public function coordinador(){
        return $this->belongsTo('grupos','id_grupo','id_grupo');
    }
}
