<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; // <- ini penting, defaultnya pakai nama "user", padahal kita pakai "users"
    protected $primaryKey = 'id';

    protected $allowedFields = ['nama', 'nis', 'email', 'password', 'role', 'created_at'];
}
