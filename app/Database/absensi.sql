-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jul 2025 pada 17.20
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('hadir','izin','sakit','alfa','terkonfirmasi') NOT NULL,
  `keterangan` text DEFAULT NULL,
  `bukti` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu') NOT NULL,
  `mapel` varchar(100) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id`, `hari`, `mapel`, `jam_mulai`, `jam_selesai`, `created_at`) VALUES
(13, 'Kamis', 'Organisasi Digital', '13:00:00', '14:50:00', '2025-05-22 00:29:21'),
(14, 'Kamis', 'Leadership and Social Influence', '09:00:00', '10:50:00', '2025-05-22 07:37:32'),
(15, 'Jumat', 'Bahasa Inggris', '09:00:00', '10:50:00', '2025-05-22 07:44:40'),
(16, 'Jumat', 'Pendidikan Kewarganegaraan', '13:00:00', '15:00:00', '2025-05-22 07:45:33'),
(17, 'Senin', 'Basis Data', '07:00:00', '08:50:00', '2025-05-22 07:46:37'),
(18, 'Senin', 'Matematika Diskrit', '10:00:00', '11:50:00', '2025-05-22 07:47:35'),
(19, 'Selasa', 'Praktikum Basis Data', '07:00:00', '08:50:00', '2025-05-22 07:48:16'),
(20, 'Selasa', 'Rekayasa Perangkat Lunak', '10:00:00', '11:50:00', '2025-05-22 07:49:11'),
(21, 'Selasa', 'Keachmadyanian', '11:00:00', '15:00:00', '2025-05-22 07:49:42'),
(22, 'Rabu', 'Sistem Operasi', '11:00:00', '12:50:00', '2025-05-28 17:26:14'),
(23, 'Kamis', 'Praktikum Sistem Operasi', '07:00:00', '08:50:00', '2025-05-29 16:51:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nis` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','guru','siswa') NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `nis`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Admin Sekolah', NULL, 'admin@admin.com', '1', 'admin', '2025-05-21 18:42:53'),
(39, 'Akun Presentasi', '0987654321', 'presentasi@sekolah.com', '1', 'siswa', '2025-07-02 19:21:14'),
(40, 'Guru Presentasi', NULL, 'gurupresentasi@guru.com', '1', 'guru', '2025-07-02 19:28:22');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
