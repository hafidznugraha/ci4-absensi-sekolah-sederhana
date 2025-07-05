<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table = 'jadwal';
    protected $allowedFields = ['hari', 'mapel', 'jam_mulai', 'jam_selesai'];
}
