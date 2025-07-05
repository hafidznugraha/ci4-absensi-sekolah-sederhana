<?php

namespace App\Controllers;

use App\Models\AbsensiModel;
use App\Models\JadwalModel;
use App\Models\UserModel;

class Siswa extends BaseController
{
    protected $absensiModel;

    public function __construct()
    {
        $this->absensiModel = new AbsensiModel();
    }

    protected function cekLoginSiswa()
    {
        $session = session();
        if (! $session->get('logged_in') || $session->get('role') !== 'siswa') {
            return redirect()->to('/login')->send();
        }
    }

    public function index()
    {
        return redirect()->to('/siswa/beranda');
    }

    public function beranda()
    {
        $this->cekLoginSiswa();

        $hariIng = date('l');
        $mapHari = [
            'Sunday'    => 'Minggu',
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu',
        ];
        $hariIndo = $mapHari[$hariIng] ?? $hariIng;

        $isWeekend = in_array($hariIng, ['Saturday', 'Sunday']);

        $jadwalModel = new JadwalModel();
        $jadwalHariIni = [];
        if (! $isWeekend) {
            $jadwalHariIni = $jadwalModel
                ->where('hari', $hariIndo)
                ->orderBy('jam_mulai', 'ASC')
                ->findAll();
        }

        $today = date('Y-m-d');
        $already = (bool) $this->absensiModel
            ->where('nama', session()->get('nama'))
            ->where('nis',  session()->get('nis'))
            ->where('tanggal', $today)
            ->first();

        $bisaAbsen = !$isWeekend && !empty($jadwalHariIni) && !$already;

        return view('siswa/beranda', [
            'nama'          => session()->get('nama'),
            'nis'           => session()->get('nis'),
            'jadwal'        => $jadwalHariIni,
            'alreadyAbsen'  => $already,
            'isWeekend'     => $isWeekend,
            'bisaAbsen'     => $bisaAbsen,
        ]);
    }

    public function absen()
    {
        $this->cekLoginSiswa();

        $hariIng = date('l');
        $mapHari = [
            'Sunday'    => 'Minggu',
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu',
        ];
        $hariIndo = $mapHari[$hariIng] ?? $hariIng;
        $isWeekend = in_array($hariIng, ['Saturday', 'Sunday']);

        $jadwalModel = new JadwalModel();
        $jadwalHariIni = $isWeekend ? [] : $jadwalModel->where('hari', $hariIndo)->findAll();

        $today = date('Y-m-d');
        $sudahAbsen = $this->absensiModel
            ->where('nama', session()->get('nama'))
            ->where('nis',  session()->get('nis'))
            ->where('tanggal', $today)
            ->first();

        $now = date('H:i:s');
        $jamMulai = '07:00:00';
        $jamSelesai = '12:00:00';

        if ($isWeekend || empty($jadwalHariIni)) {
            return redirect()->to('/siswa/beranda')->with('error', 'Tidak dapat absensi untuk hari ini.');
        }

        if ($now < $jamMulai || $now > $jamSelesai) {
            return redirect()->to('/siswa/beranda')->with('error', 'Absensi hanya dapat dilakukan pukul 07:00 - 12:00.');
        }

        if ($sudahAbsen) {
            return redirect()->to('/siswa/beranda')->with('error', 'Anda sudah melakukan absensi hari ini!');
        }

        return view('siswa/absen');
    }

    public function submitAbsen()
    {
        $this->cekLoginSiswa();

        $hariIng = date('l');
        $mapHari = [
            'Sunday'    => 'Minggu',
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu',
        ];
        $hariIndo = $mapHari[$hariIng] ?? $hariIng;
        $isWeekend = in_array($hariIng, ['Saturday', 'Sunday']);
        $jadwalModel = new JadwalModel();
        $jadwalHariIni = $isWeekend ? [] : $jadwalModel->where('hari', $hariIndo)->findAll();

        $today = date('Y-m-d');
        $sudahAbsen = $this->absensiModel
            ->where('nama', session()->get('nama'))
            ->where('nis',  session()->get('nis'))
            ->where('tanggal', $today)
            ->first();

        if ($isWeekend || empty($jadwalHariIni)) {
            return redirect()->to('/siswa/beranda')->with('error', 'Tidak dapat absensi untuk hari ini.');
        }

        if ($sudahAbsen) {
            return redirect()->to('/siswa/beranda')->with('error', 'Anda sudah melakukan absensi hari ini!');
        }

        $status     = $this->request->getPost('status');
        $keterangan = $this->request->getPost('keterangan');

        $data = [
            'nama'       => session()->get('nama'),
            'nis'        => session()->get('nis'),
            'tanggal'    => $today,
            'status'     => $status,
            'keterangan' => $keterangan ?: null,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        if (in_array($status, ['sakit', 'izin'])) {
            $file = $this->request->getFile('bukti');
            if (! $file || ! $file->isValid()) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Silakan unggah bukti untuk status ' . $status . '.');
            }
            $allowed = ['image/jpeg', 'image/png', 'application/pdf'];
            if (! in_array($file->getMimeType(), $allowed) || $file->getSize() > 2 * 1024 * 1024) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Bukti harus PDF/Gambar dan ≤ 2MB.');
            }
            $dest = FCPATH . 'uploads/bukti';
            if (! is_dir($dest)) {
                mkdir($dest, 0777, true);
            }
            $newName = $file->getRandomName();
            $file->move($dest, $newName);
            $data['bukti'] = 'uploads/bukti/' . $newName;
        }

        $this->absensiModel->insert($data);

        return redirect()->to('/siswa/beranda')
            ->with('success', 'Absensi hari ini berhasil dikirim!');
    }

    public function riwayat()
    {
        $this->cekLoginSiswa();
        $nama = session('nama');
        $nis  = session('nis');
        $riwayat = $this->absensiModel
            ->where('nama', $nama)
            ->where('nis', $nis)
            ->orderBy('tanggal', 'DESC')
            ->findAll();

        return view('siswa/riwayat', [
            'riwayat' => $riwayat,
            'nama'    => $nama,
            'nis'     => $nis,
        ]);
    }

    public function profil()
    {
        $this->cekLoginSiswa();
        $userModel = new UserModel();
        $user = $userModel->find(session()->get('user_id'));

        return view('siswa/profil', [
            'user' => $user,
        ]);
    }

    public function editProfil()
    {
        $this->cekLoginSiswa();
        $userModel = new UserModel();
        $user = $userModel->find(session()->get('user_id'));

        return view('siswa/edit_profil', [
            'user' => $user
        ]);
    }

    public function updateProfil()
    {
        $this->cekLoginSiswa();
        $password = $this->request->getPost('password');
        if (empty($password)) {
            return redirect()->back()->with('error', 'Password tidak boleh kosong.');
        }
        $userModel = new \App\Models\UserModel();
        $userModel->update(
            session()->get('user_id'),
            ['password' => $password]
        );
        return redirect()
            ->to(base_url('siswa/profil'))
            ->with('success', 'Password berhasil diubah.');
    }
}
