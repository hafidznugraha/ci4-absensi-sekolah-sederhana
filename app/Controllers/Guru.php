<?php

namespace App\Controllers;

use App\Models\AbsensiModel;
use Dompdf\Dompdf;

class Guru extends BaseController
{
    public function index()
    {
        return redirect()->to('/guru/beranda');
    }

    public function beranda()
    {
        $this->cekLoginGuru();

        $absensiModel = new \App\Models\AbsensiModel();

        $absensi = $absensiModel
            ->select([
                'id',
                'nama',
                'nis',
                'status',
                'keterangan',
                'bukti',
                'created_at AS waktu',
            ])
            ->where('tanggal', date('Y-m-d'))
            ->orderBy('created_at', 'ASC')
            ->findAll();

        $map = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];

        $hariIng = date('l');
        $data = [
            'absensi' => $absensi,
            'nama'    => session()->get('nama'),
            'hari'    => $map[$hariIng] ?? $hariIng,
        ];

        return view('guru/beranda', $data);
    }

    public function konfirmasi($id)
    {
        $absensiModel = new AbsensiModel();
        $absensiModel->update($id, ['status' => 'terkonfirmasi']);
        return redirect()->to('/guru/beranda');
    }

    private function cekLoginGuru()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'guru') {
            return redirect()->to('/login')->send();
        }
    }

    public function rekap()
    {
        $this->cekLoginGuru();

        $absensiModel = new \App\Models\AbsensiModel();
        $absensi = $absensiModel
            ->select(['id', 'nama', 'nis', 'status', 'created_at AS waktu'])
            ->where('tanggal', date('Y-m-d'))        // atau rentang tanggal tertentu
            ->orderBy('created_at', 'ASC')
            ->findAll();

        $html = view('guru/rekap_pdf', [
            'nama'     => session('nama'),
            'hari'     => date('d-m-Y'),
            'absensi'  => $absensi,
        ]);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        return $dompdf->stream(
            'rekap-absensi-' . date('Ymd') . '.pdf',
            ['Attachment' => true]
        );
    }

    public function profil()
    {
        $this->cekLoginGuru();

        $userModel = new \App\Models\UserModel();
        $guru      = $userModel->find(session()->get('user_id'));

        return view('guru/profil', [
            'user' => $guru,
        ]);
    }

    public function updateProfil()
    {
        $this->cekLoginGuru();
        $idGuru   = session()->get('user_id');
        $password = $this->request->getPost('password');

        $userModel = new \App\Models\UserModel();
        $userModel->update($idGuru, [
            'password' => $password,
        ]);

        return redirect()
            ->to('/guru/profil')
            ->with('success', 'Password berhasil diubah.');
    }
}
