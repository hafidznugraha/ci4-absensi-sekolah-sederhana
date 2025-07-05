<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/x-icon">
    <style>
        body {
            background-color: #F0F3FA;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 16px;
        }

        .container-custom {
            max-width: 700px;
            margin: auto;
        }

        .card {
            background: white;
            border-radius: 16px;
            padding: 20px 24px;
            border: 1px solid #D5DEEF;
            margin-bottom: 24px;
        }

        .btn-primary {
            background-color: #628ECB;
            border-color: #628ECB;
        }

        .btn-primary:hover {
            background-color: #395886;
            border-color: #395886;
        }

        h5,
        h6 {
            font-weight: 600;
        }

        .nav-link:hover {
            color: #395886;
            transition: 0.2s;
        }

        @media (min-width: 768px) {
            body {
                padding-top: 100px;
            }
        }

        @media (max-width: 767px) {
            .container-custom {
                margin-top: 10px !important;
                padding-top: 0 !important;
            }
        }
    </style>
</head>

<body>
    <!-- nav desktop -->
    <nav class="navbar navbar-expand bg-white border-bottom shadow-sm d-none d-md-flex position-fixed top-0 start-0 end-0 px-4 py-2 z-3">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo" style="height: 36px;">
                <span class="fw-semibold text-primary">SMP SHANTI SATYA SUNDARA</span>
            </div>
            <div class="d-flex gap-4 text-center">
                <a href="<?= base_url('siswa/beranda') ?>" class="nav-link text-dark <?= service('uri')->getSegment(2) === 'beranda' ? 'fw-bold text-primary' : '' ?>">
                    <div><i class="bi bi-house-fill"></i><br><small>Beranda</small></div>
                </a>
                <a href="<?= base_url('siswa/riwayat') ?>" class="nav-link text-dark <?= service('uri')->getSegment(2) === 'riwayat' ? 'fw-bold text-primary' : '' ?>">
                    <div><i class="bi bi-clock-history"></i><br><small>Riwayat</small></div>
                </a>
                <a href="<?= base_url('siswa/profil') ?>" class="nav-link text-dark <?= service('uri')->getSegment(2) === 'profil' ? 'fw-bold text-primary' : '' ?>">
                    <div><i class="bi bi-person-fill"></i><br><small>Profil</small></div>
                </a>
                <a href="<?= base_url('logout') ?>" class="nav-link text-danger">
                    <div><i class="bi bi-box-arrow-right"></i><br><small>Logout</small></div>
                </a>
            </div>
        </div>
    </nav>

    <div class="container-custom">
        <div class="card text-center">
            <h5 class="mb-1">Hi, <?= esc($nama) ?>!</h5>
            <p class="mb-0"><small>NIS: <?= esc($nis) ?></small></p>
        </div>

        <div class="card">
            <h6 class="mb-3">Jadwal Hari Ini</h6>
            <?php if (!empty($jadwal)): ?>
                <ul class="list-group">
                    <?php foreach ($jadwal as $item): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><?= esc($item['mapel']) ?></span>
                            <span class="text-muted"><?= date('H:i', strtotime($item['jam_mulai'])) ?> - <?= date('H:i', strtotime($item['jam_selesai'])) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-muted mb-0">Hari ini libur.</p>
            <?php endif; ?>
        </div>

        <div class="card text-center">
            <p class="mb-3">Sudah siap untuk mengisi absensi hari ini?</p>

            <?php
            $hariIni = date('l');
            $isWeekend = ($hariIni == 'Saturday' || $hariIni == 'Sunday');
            $adaJadwal = !empty($jadwal);
            ?>

            <?php if ($alreadyAbsen): ?>
                <button class="btn btn-secondary w-100" disabled>
                    Sudah melakukan absensi
                </button>
            <?php elseif ($isWeekend || !$adaJadwal): ?>
                <button class="btn btn-secondary w-100" disabled>
                    Tidak dapat absensi untuk hari ini
                </button>
            <?php else: ?>
                <?php
                $jamSekarang = date('H:i');
                $buka  = '07:00';
                $tutup = '12:00';
                $bisaAbsen = ($jamSekarang >= $buka && $jamSekarang <= $tutup);
                ?>
                <?php if ($bisaAbsen): ?>
                    <a href="<?= base_url('siswa/absen') ?>"
                        class="btn btn-primary w-100">
                        Isi Absensi
                    </a>
                <?php else: ?>
                    <button class="btn btn-primary w-100"
                        data-bs-toggle="modal"
                        data-bs-target="#modalPeringatan">
                        Isi Absensi
                    </button>
                <?php endif ?>
            <?php endif ?>
        </div>
    </div>

    <div class="modal fade" id="modalPeringatan" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title m-auto" id="modalLabel">Peringatan</h5>
                </div>
                <div class="modal-body text-center">
                    Absensi hanya bisa dilakukan antara <strong>07:00 - 12:00</strong>.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Oke</button>
                </div>
            </div>
        </div>
    </div>

    <!-- nav mobile -->
    <nav class="navbar fixed-bottom bg-white border-top d-flex d-md-none w-100">
        <div class="container d-flex justify-content-around text-center">
            <a href="<?= base_url('siswa/beranda') ?>" class="text-decoration-none <?= service('uri')->getSegment(2) == 'beranda' ? 'text-primary fw-bold' : 'text-dark' ?>">
                <div><i class="bi bi-house-fill"></i><br><small>Beranda</small></div>
            </a>
            <a href="<?= base_url('siswa/riwayat') ?>" class="text-decoration-none <?= service('uri')->getSegment(2) == 'riwayat' ? 'text-primary fw-bold' : 'text-dark' ?>">
                <div><i class="bi bi-clock-history"></i><br><small>Riwayat</small></div>
            </a>
            <a href="<?= base_url('siswa/profil') ?>" class="text-decoration-none <?= service('uri')->getSegment(2) == 'profil' ? 'text-primary fw-bold' : 'text-dark' ?>">
                <div><i class="bi bi-person-fill"></i><br><small>Profil</small></div>
            </a>
            <a href="<?= base_url('logout') ?>" class="text-decoration-none text-danger">
                <div><i class="bi bi-box-arrow-right"></i><br><small>Logout</small></div>
            </a>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>