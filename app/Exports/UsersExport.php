<?php

namespace App\Exports;
use App\User;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return DB::table('users')
        ->join('tipo_usuarios','tipo_usuarios.id_tipo_usuario','users.id_tipo_usuario')
        ->join('roles','roles.id_rol','users.id_rol')->get();
        
    }
}
