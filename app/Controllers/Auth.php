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
        $model   = new \App\Models\UserModel();

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $role     = $this->request->getPost('role');

        $user = $model->where('email', $email)
            ->where('password', $password)
            ->where('role', strtolower($role))
            ->first();

        if (!$user) {
            $userCheck = $model->where('email', $email)
                ->where('password', $password)
                ->first();

            if ($userCheck) {
                return redirect()->back()->with('error', 'Role login salah. Pilih "Admin" untuk akun admin.');
            } else {
                return redirect()->back()->with('error', 'Email atau password salah!');
            }
        }

        $session->set([
            'logged_in' => true,
            'user_id'   => $user['id'],
            'nama'      => $user['nama'],
            'role'      => $user['role'],
            'nis'       => $user['nis'] ?? null,
            'email'     => $user['email'],
        ]);

        if ($user['role'] === 'admin') {
            return redirect()->to('/admin/dashboard');
        } elseif ($user['role'] === 'guru') {
            return redirect()->to('/guru');
        } elseif ($user['role'] === 'siswa') {
            return redirect()->to('/siswa');
        } else {
            return redirect()->back()->with('error', 'Role tidak valid!');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
