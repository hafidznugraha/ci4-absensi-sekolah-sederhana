<?php

namespace Config;

$routes = Services::routes();

// =====================================
// ROOT / DEFAULT
// =====================================
$routes->get('/', 'Auth::login');


// =====================================
// AUTH
// =====================================
$routes->get('login', 'Auth::login');
$routes->post('auth/process', 'Auth::process');
$routes->get('logout', 'Auth::logout');
$routes->get('auth/logout', 'Auth::logout');


// =====================================
// ADMIN
// =====================================
$routes->group('admin', function ($routes) {

    $routes->get('/', 'Admin::index');
    $routes->get('dashboard', 'Admin::dashboard');

    // Siswa
    $routes->get('siswa', 'Admin::siswa');
    $routes->post('siswa/tambah', 'Admin::tambahSiswa');
    $routes->post('siswa/update', 'Admin::updateSiswa');
    $routes->get('siswa/hapus/(:num)', 'Admin::hapusSiswa/$1');
    $routes->get('siswa/rekap-pdf', 'Admin::rekapSiswaPdf');

    // Guru
    $routes->get('guru', 'Admin::guru');
    $routes->post('guru/tambah', 'Admin::tambahGuru');
    $routes->post('guru/update', 'Admin::updateGuru');
    $routes->get('guru/hapus/(:num)', 'Admin::hapusGuru/$1');
    $routes->get('guru/rekap-pdf', 'Admin::rekapGuruPdf');

    // Jadwal
    $routes->get('jadwal', 'Admin::jadwal');
    $routes->post('jadwal/tambah', 'Admin::tambahJadwal');
    $routes->post('jadwal/update', 'Admin::updateJadwal');
    $routes->get('jadwal/hapus/(:num)', 'Admin::hapusJadwal/$1');
    $routes->get('jadwal/rekap-pdf', 'Admin::rekapJadwalPdf');
});


// =====================================
// GURU
// =====================================
$routes->group('guru', ['filter' => 'roleGuru'], function ($routes) {

    $routes->get('/', 'Guru::index');
    $routes->get('beranda', 'Guru::beranda');
    $routes->get('rekap', 'Guru::rekap');
    $routes->get('konfirmasi/(:num)', 'Guru::konfirmasi/$1');

    $routes->get('profil', 'Guru::profil');
    $routes->post('profil/update', 'Guru::updateProfil');
});


// =====================================
// SISWA
// =====================================
$routes->group('siswa', ['filter' => 'roleSiswa'], function ($routes) {

    $routes->get('/', 'Siswa::index');
    $routes->get('beranda', 'Siswa::beranda');
    $routes->get('absen', 'Siswa::absen');
    $routes->post('submit', 'Siswa::submitAbsen');
    $routes->get('riwayat', 'Siswa::riwayat');

    $routes->get('profil', 'Siswa::profil');
    $routes->post('profil/update', 'Siswa::updateProfil');
});