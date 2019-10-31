<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function mapping(): array
    {
        return [
            'name'  => 'B1',
            'email' => 'B2',
        ];
    }
    public function model(array $row)
    {
        return new User([
           'nombre_usuario'     => $row[0],
           'email'              => $row[1],
        ]);
    }
}
