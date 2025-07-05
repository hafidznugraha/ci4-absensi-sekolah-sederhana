<?php

namespace App\Models;

use CodeIgniter\Model;

class GuruModel extends Model
{
    protected $table      = 'users';        // pakai tabel users
    protected $primaryKey = 'id';           // sesuaikan primaryKey
    protected $allowedFields = [
        'nama',
        'email',
        'password',
        'role', // dst
    ];
}
