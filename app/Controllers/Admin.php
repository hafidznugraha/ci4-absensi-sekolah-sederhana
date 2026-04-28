<?php

namespace App\Controllers;

use App\Models\JadwalModel;
use App\Models\UserModel;
use Dompdf\Dompdf;

class Admin extends BaseController
{
    protected function cekLoginAdmin()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to(base_url('login'))->send();
            exit;
        }
    }

    protected function generatePdf($view, $data, $filename = 'file.pdf', $orientation = 'portrait')
    {
        $dompdf = new Dompdf();

        $html = view($view, $data);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', $orientation);
        $dompdf->render();

        $dompdf->stream($filename, ['Attachment' => false]);
        exit();
    }

    public function index()
    {
        $redirect = $this->cekLoginAdmin();
        if ($redirect) return $redirect;

        return redirect()->to('/admin/dashboard');
    }

    public function dashboard()
    {
        $redirect = $this->cekLoginAdmin();
        if ($redirect) return $redirect;

        $userModel   = new UserModel();
        $jadwalModel = new JadwalModel();

        $data = [
            'totalSiswa'  => $userModel->where('role', 'siswa')->countAllResults(),
            'totalGuru'   => $userModel->where('role', 'guru')->countAllResults(),
            'totalJadwal' => $jadwalModel->countAll(),
            'totalAkun'   => $userModel->countAll()
        ];

        return view('admin/dashboard', $data);
    }

    public function siswa()
    {
        $redirect = $this->cekLoginAdmin();
        if ($redirect) return $redirect;

        $userModel = new UserModel();

        $data['siswa'] = $userModel
            ->where('role', 'siswa')
            ->findAll();

        return view('admin/siswa', $data);
    }

    public function rekapSiswaPdf()
    {
        $redirect = $this->cekLoginAdmin();
        if ($redirect) return $redirect;

        $userModel = new UserModel();

        $data['siswa'] = $userModel
            ->where('role', 'siswa')
            ->findAll();

        return $this->generatePdf(
            'admin/rekap_siswa_pdf',
            $data,
            'rekap-data-siswa.pdf'
        );
    }

    public function tambahSiswa()
    {
        $redirect = $this->cekLoginAdmin();
        if ($redirect) return $redirect;

        $db = \Config\Database::connect();

        $data = [
            'nama'       => $this->request->getPost('nama'),
            'nis'        => $this->request->getPost('nis'),
            'email'      => $this->request->getPost('email') . '@sekolah.com',
            'password'   => $this->request->getPost('password'),
            'role'       => 'siswa',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $db->table('users')->insert($data);

        return redirect()->to(base_url('admin/siswa'))
            ->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function updateSiswa()
    {
        $redirect = $this->cekLoginAdmin();
        if ($redirect) return $redirect;

        $id          = $this->request->getPost('id');
        $emailPrefix = trim($this->request->getPost('email_prefix'));

        $data = [
            'nama'  => $this->request->getPost('nama'),
            'nis'   => $this->request->getPost('nis'),
            'email' => $emailPrefix . '@sekolah.com',
        ];

        $password = $this->request->getPost('password');

        if (!empty($password)) {
            $data['password'] = $password;
        }

        $userModel = new UserModel();
        $userModel->update($id, $data);

        return redirect()->to(base_url('admin/siswa'));
    }

    public function hapusSiswa($id)
    {
        $redirect = $this->cekLoginAdmin();
        if ($redirect) return $redirect;

        $userModel = new UserModel();
        $userModel->delete($id);

        return redirect()->to(base_url('admin/siswa'));
    }

    public function guru()
    {
        $redirect = $this->cekLoginAdmin();
        if ($redirect) return $redirect;

        $userModel = new UserModel();

        $data['guru'] = $userModel
            ->where('role', 'guru')
            ->findAll();

        return view('admin/guru', $data);
    }

    public function rekapGuruPdf()
    {
        $redirect = $this->cekLoginAdmin();
        if ($redirect) return $redirect;

        $userModel = new UserModel();

        $data['guru'] = $userModel
            ->where('role', 'guru')
            ->findAll();

        return $this->generatePdf(
            'admin/rekap_guru_pdf',
            $data,
            'rekap-data-guru.pdf'
        );
    }

    public function tambahGuru()
    {
        $redirect = $this->cekLoginAdmin();
        if ($redirect) return $redirect;

        $data = [
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email_prefix') . '@guru.com',
            'password' => $this->request->getPost('password'),
            'role'     => 'guru'
        ];

        $userModel = new UserModel();
        $userModel->insert($data);

        return redirect()->to(base_url('admin/guru'));
    }

    public function updateGuru()
    {
        $redirect = $this->cekLoginAdmin();
        if ($redirect) return $redirect;

        $id = $this->request->getPost('id');

        $data = [
            'nama'  => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email_prefix') . '@guru.com',
        ];

        $password = $this->request->getPost('password');

        if (!empty($password)) {
            $data['password'] = $password;
        }

        $userModel = new UserModel();
        $userModel->update($id, $data);

        return redirect()->to(base_url('admin/guru'));
    }

    public function hapusGuru($id)
    {
        $redirect = $this->cekLoginAdmin();
        if ($redirect) return $redirect;

        $userModel = new UserModel();
        $userModel->delete($id);

        return redirect()->to(base_url('admin/guru'));
    }

    public function jadwal()
    {
        $redirect = $this->cekLoginAdmin();
        if ($redirect) return $redirect;

        $jadwalModel = new JadwalModel();

        $data['jadwal'] = $jadwalModel
            ->orderBy("
                CASE
                    WHEN hari = 'Senin' THEN 1
                    WHEN hari = 'Selasa' THEN 2
                    WHEN hari = 'Rabu' THEN 3
                    WHEN hari = 'Kamis' THEN 4
                    WHEN hari = 'Jumat' THEN 5
                    ELSE 99
                END
            ", '', false)
            ->orderBy('jam_mulai', 'ASC')
            ->findAll();

        return view('admin/jadwal', $data);
    }

    public function tambahJadwal()
    {
        $redirect = $this->cekLoginAdmin();
        if ($redirect) return $redirect;

        $jadwalModel = new JadwalModel();

        $hari       = $this->request->getPost('hari');
        $mapel      = $this->request->getPost('mapel');
        $jamMulai   = $this->request->getPost('jam_mulai');
        $jamSelesai = $this->request->getPost('jam_selesai');

        if ($jamSelesai <= $jamMulai) {
            return redirect()->back()
                ->with('error', 'Jam selesai harus lebih besar dari jam mulai.');
        }

        $bentrok = $jadwalModel
            ->where('hari', $hari)
            ->groupStart()
            ->where("'$jamMulai' < jam_selesai")
            ->where("'$jamSelesai' > jam_mulai")
            ->groupEnd()
            ->first();

        if ($bentrok) {
            return redirect()->back()
                ->with('error', 'Jadwal bentrok dengan jadwal lain di hari yang sama.');
        }

        $jadwalModel->insert([
            'hari'        => $hari,
            'mapel'       => $mapel,
            'jam_mulai'   => $jamMulai,
            'jam_selesai' => $jamSelesai,
        ]);

        return redirect()->to(base_url('admin/jadwal'));
    }

    public function updateJadwal()
    {
        $redirect = $this->cekLoginAdmin();
        if ($redirect) return $redirect;

        $jadwalModel = new JadwalModel();

        $id         = $this->request->getPost('id');
        $hari       = $this->request->getPost('hari');
        $mapel      = $this->request->getPost('mapel');
        $jamMulai   = $this->request->getPost('jam_mulai');
        $jamSelesai = $this->request->getPost('jam_selesai');

        if ($jamSelesai <= $jamMulai) {
            return redirect()->back()
                ->with('error', 'Jam selesai harus lebih besar dari jam mulai.');
        }

        $bentrok = $jadwalModel
            ->where('hari', $hari)
            ->where('id !=', $id)
            ->groupStart()
            ->where("'$jamMulai' < jam_selesai")
            ->where("'$jamSelesai' > jam_mulai")
            ->groupEnd()
            ->first();

        if ($bentrok) {
            return redirect()->back()
                ->with('error', 'Jadwal bentrok dengan jadwal lain di hari yang sama.');
        }

        $jadwalModel->update($id, [
            'hari'        => $hari,
            'mapel'       => $mapel,
            'jam_mulai'   => $jamMulai,
            'jam_selesai' => $jamSelesai,
        ]);

        return redirect()->to(base_url('admin/jadwal'));
    }

    public function hapusJadwal($id)
    {
        $redirect = $this->cekLoginAdmin();
        if ($redirect) return $redirect;

        $jadwalModel = new JadwalModel();
        $jadwalModel->delete($id);

        return redirect()->to(base_url('admin/jadwal'));
    }

    public function rekapJadwalPdf()
    {
        $redirect = $this->cekLoginAdmin();
        if ($redirect) return $redirect;

        $jadwalModel = new JadwalModel();

        $data['jadwal'] = $jadwalModel
            ->orderBy("
                CASE
                    WHEN hari = 'Senin' THEN 1
                    WHEN hari = 'Selasa' THEN 2
                    WHEN hari = 'Rabu' THEN 3
                    WHEN hari = 'Kamis' THEN 4
                    WHEN hari = 'Jumat' THEN 5
                    ELSE 99
                END
            ", '', false)
            ->orderBy('jam_mulai', 'ASC')
            ->findAll();

        return $this->generatePdf(
            'admin/rekap_jadwal_pdf',
            $data,
            'rekap-jadwal.pdf'
        );
    }
}