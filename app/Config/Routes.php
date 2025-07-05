<?php
// Auth
$routes->get('/login', 'Auth::login');
$routes->post('/auth/process', 'Auth::process');
$routes->get('logout', 'Auth::logout');
$routes->get('auth/logout', 'Auth::logout');

// Admin
$routes->get('admin/dashboard', 'Admin::dashboard');
$routes->get('/admin', 'Admin::index');
$routes->get('/admin/siswa', 'Admin::siswa');
$routes->post('admin/siswa/tambah', 'Admin::tambahSiswa');
$routes->post('admin/siswa/update', 'Admin::updateSiswa');
$routes->get('admin/siswa/hapus/(:num)', 'Admin::hapusSiswa/$1');
$routes->get('admin/guru', 'Admin::guru');
$routes->post('admin/guru/tambah', 'Admin::tambahGuru');
$routes->post('admin/guru/update', 'Admin::updateGuru');
$routes->get('admin/guru/hapus/(:num)', 'Admin::hapusGuru/$1');
$routes->get('admin/jadwal', 'Admin::jadwal');
$routes->post('admin/jadwal/tambah', 'Admin::tambahJadwal');
$routes->post('admin/jadwal/update', 'Admin::updateJadwal');
$routes->get('admin/jadwal/hapus/(:num)', 'Admin::hapusJadwal/$1');
$routes->get('admin/siswa/rekap-pdf', 'Admin::rekapSiswaPdf');
$routes->get('admin/guru/rekap-pdf', 'Admin::rekapGuruPdf');
$routes->get('/admin/jadwal', 'Admin::jadwal');

// Guru
$routes->group('guru', ['filter' => 'roleGuru'], function ($r) {
    $r->get('/',             'Guru::index');
    $r->get('beranda',       'Guru::beranda');
    $r->get('rekap',         'Guru::rekap');
    $r->get('konfirmasi/(:num)', 'Guru::konfirmasi/$1');
    $r->get('profil',        'Guru::profil');
    $r->post('profil/update', 'Guru::updateProfil');
});

// Siswa
$routes->group('siswa', ['filter' => 'roleSiswa'], function ($routes) {
    $routes->get('', 'Siswa::index');
    $routes->get('beranda',        'Siswa::beranda');
    $routes->get('absen',          'Siswa::absen');
    $routes->post('submit',        'Siswa::submitAbsen');
    $routes->get('riwayat',        'Siswa::riwayat');
    $routes->get('profil',         'Siswa::profil');
    $routes->post('profil/update', 'Siswa::updateProfil');
});