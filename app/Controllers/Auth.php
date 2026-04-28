<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function process()
    {
        $session = session();
        $model   = new UserModel();

        $email    = trim($this->request->getPost('email'));
        $password = trim($this->request->getPost('password'));

        // Cari user berdasarkan email dan password
        $user = $model->where('email', $email)
            ->where('password', $password)
            ->first();

        // Jika user tidak ditemukan
        if (!$user) {
            return redirect()->back()->with('error', 'Email atau password salah!');
        }

        /*
        |--------------------------------------------------------------------------
        | AUTO DETEKSI ROLE
        |--------------------------------------------------------------------------
        | Prioritas utama ambil dari kolom role di database.
        | Jika kosong, fallback deteksi dari domain email.
        */
        $role = strtolower($user['role'] ?? '');

        if (empty($role)) {
            if (str_contains($email, '@admin.com')) {
                $role = 'admin';
            } elseif (str_contains($email, '@guru.com')) {
                $role = 'guru';
            } elseif (str_contains($email, '@sekolah.com')) {
                $role = 'siswa';
            }
        }

        // Jika role tetap kosong / tidak dikenali
        if (!in_array($role, ['admin', 'guru', 'siswa'])) {
            return redirect()->back()->with('error', 'Role akun tidak valid!');
        }

        // Simpan session
        $session->set([
            'logged_in' => true,
            'user_id'   => $user['id'],
            'nama'      => $user['nama'],
            'role'      => $role,
            'nis'       => $user['nis'] ?? null,
            'email'     => $user['email'],
        ]);

        // Redirect sesuai role
        if ($role === 'admin') {
            return redirect()->to('/admin/dashboard');
        } elseif ($role === 'guru') {
            return redirect()->to('/guru');
        } elseif ($role === 'siswa') {
            return redirect()->to('/siswa');
        }

        return redirect()->back()->with('error', 'Terjadi kesalahan login!');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
