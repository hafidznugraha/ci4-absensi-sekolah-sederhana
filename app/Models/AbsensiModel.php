<?php namespace App\Models;

use CodeIgniter\Model;

class AbsensiModel extends Model
{
    protected $table      = 'absensi';
    protected $primaryKey = 'id';

    // Hanya kolom‐kolom ini yang diijinkan untuk insert/update
    protected $allowedFields = [
        'id',
        'nama',
        'nis',
        'tanggal',
        'status',
        'keterangan',
        'bukti',
        'created_at'
    ];

    // Non-aktifkan otomatis insert created_at / updated_at
    protected $useTimestamps = false;
}
