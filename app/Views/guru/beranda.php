<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/x-icon">
    <style>
        body {
            background-color: #F0F3FA;
            padding-top: 70px;
        }

        .main-container {
            max-width: 1000px;
            margin: 0 auto;
            margin-bottom: 85px;
            padding-left: 18px;
            padding-right: 18px;
        }

        .content-container {
            background: white;
            padding: 24px 20px 20px 20px;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        @media (max-width: 767px) {
            body {
                padding-top: 16px !important;
            }

            .main-container {
                max-width: 100%;
                margin-bottom: 95px;
                padding-left: 10px;
                padding-right: 10px;
            }

            .content-container {
                padding: 15px 10px 15px 10px !important;
                border-radius: 13px;
                box-shadow: 0 4px 18px rgba(0, 0, 0, 0.11);
            }

            .content-container h3,
            .content-container h4 {
                font-size: 1.08rem;
            }

            .table {
                font-size: 13px;
            }

            .btn {
                font-size: 0.97rem;
            }
        }

        .btn-outline-primary {
            white-space: nowrap;
        }

        .alert {
            font-size: 1rem;
            margin-bottom: 0;
        }

        .table-responsive {
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-light bg-white border-bottom fixed-top shadow-sm d-none d-md-flex">
        <div class="container-fluid px-4 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo" style="height:36px">
                <span class="fw-semibold text-primary">SMP SHANTI SATYA SUNDARA</span>
            </div>
            <div class="d-flex gap-4 text-center">
                <a href="<?= base_url('guru/beranda') ?>"
                    class="nav-link text-dark <?= service('uri')->getSegment(2) === 'beranda' ? 'fw-bold text-primary' : '' ?>">
                    <div><i class="bi bi-house-fill"></i><br><small>Beranda</small></div>
                </a>
                <a href="<?= base_url('guru/profil') ?>"
                    class="nav-link text-dark <?= service('uri')->getSegment(2) === 'profil' ? 'fw-bold text-primary' : '' ?>">
                    <div><i class="bi bi-person-circle"></i><br><small>Profil</small></div>
                </a>
                <a href="<?= base_url('logout') ?>" class="nav-link text-danger">
                    <div><i class="bi bi-box-arrow-right"></i><br><small>Logout</small></div>
                </a>
            </div>
        </div>
    </nav>

    <div class="main-container py-3">
        <div class="content-container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3 gap-2">
                <div>
                    <div class="fw-semibold">Selamat datang, <?= esc($nama) ?></div>
                    <div class="fw-normal mb-1">Daftar Absensi Hari Ini (<?= esc($hari) ?>)</div>
                </div>
                <a href="<?= base_url('guru/rekap') ?>" class="btn btn-outline-primary mt-2 mt-md-0">
                    <i class="bi bi-file-earmark-pdf"></i> Rekap PDF
                </a>
            </div>

            <?php if (! empty($absensi)): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Nama Siswa</th>
                                <th>NIS</th>
                                <th>Waktu Absen</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Bukti</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($absensi as $i => $row): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= esc($row['nama']) ?></td>
                                    <td><?= esc($row['nis']) ?></td>
                                    <td><?= esc($row['waktu']) ?></td>
                                    <td><?= esc(ucfirst($row['status'])) ?></td>
                                    <td><?= esc($row['keterangan'] ?? '-') ?></td>
                                    <td>
                                        <?php if (! empty($row['bukti'])): ?>
                                            <a href="<?= base_url($row['bukti']) ?>" target="_blank" class="btn btn-sm btn-outline-secondary">
                                                Lihat
                                            </a>
                                        <?php else: ?>
                                            &mdash;
                                        <?php endif ?>
                                    </td>
                                    <td>
                                        <?php if ($row['status'] === 'Menunggu' || $row['status'] === 'menunggu'): ?>
                                            <a href="<?= base_url('guru/konfirmasi/' . $row['id']) ?>" class="btn btn-success btn-sm">
                                                Konfirmasi
                                            </a>
                                        <?php else: ?>
                                            <span class="text-success">Terkonfirmasi</span>
                                        <?php endif ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info mt-3">Belum ada data absensi hari ini.</div>
            <?php endif ?>
        </div>
    </div>

    <nav class="navbar fixed-bottom bg-white border-top d-flex d-md-none w-100">
        <div class="container d-flex justify-content-around text-center">
            <a href="<?= base_url('guru/beranda') ?>"
                class="<?= service('uri')->getSegment(2) === 'beranda' ? 'text-primary fw-bold' : 'text-dark' ?>">
                <i class="bi bi-house-fill"></i><br><small>Beranda</small>
            </a>
            <a href="<?= base_url('guru/profil') ?>"
                class="<?= service('uri')->getSegment(2) === 'profil' ? 'text-primary fw-bold' : 'text-dark' ?>">
                <i class="bi bi-person-fill"></i><br><small>Profil</small>
            </a>
            <a href="<?= base_url('logout') ?>" class="text-danger">
                <i class="bi bi-box-arrow-right"></i><br><small>Logout</small>
            </a>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>