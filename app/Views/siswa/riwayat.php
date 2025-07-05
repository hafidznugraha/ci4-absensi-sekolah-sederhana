<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/x-icon">
    <style>
        body {
            background-color: #F0F3FA;
            font-family: 'Segoe UI', sans-serif;
            padding-top: 70px;
        }

        .container-custom {
            max-width: 700px;
            margin: auto;
            margin-bottom: 32px;
        }

        .card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            border: 1px solid #D5DEEF;
        }

        .btn-primary {
            background-color: #628ECB;
            border-color: #628ECB;
        }

        .btn-primary:hover {
            background-color: #395886;
            border-color: #395886;
        }

        @media (max-width: 767px) {
            body {
                padding-top: 16px !important;
            }

            .container-custom {
                padding-left: 1rem;
                padding-right: 1rem;
                margin-top: 10px !important;
                margin-bottom: 85px !important;
                /* MARGIN BAWAH BESAR utk mobile */
                padding-bottom: 0 !important;
                padding-top: 0 !important;
            }
        }
    </style>
</head>

<body>

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

    <div class="container-custom mt-2 pt-3">
        <div class="card">
            <h4 class="mb-3">Riwayat Absensi</h4>
            <?php if (! empty($riwayat)): ?>
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Bukti</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($riwayat as $i => $row): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= esc($row['tanggal']) ?></td>
                                    <td><?= esc(ucfirst($row['status'])) ?></td>
                                    <td><?= esc($row['keterangan'] ?? '-') ?></td>
                                    <td>
                                        <?php if (! empty($row['bukti'])): ?>
                                            <a href="<?= base_url($row['bukti']) ?>"
                                                target="_blank" rel="noopener"
                                                class="btn btn-sm btn-outline-primary">
                                                Lihat
                                            </a>
                                        <?php else: ?>
                                            &mdash;
                                        <?php endif ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info mb-0">Belum ada riwayat absensi.</div>
            <?php endif ?>
        </div>
    </div>

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
</body>

</html>