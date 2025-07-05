<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
        rel="stylesheet">
    <link
        rel="icon"
        href="<?= base_url('assets/img/logo.png') ?>"
        type="image/x-icon">
    <style>
        body {
            background-color: #F0F3FA;
            font-family: 'Segoe UI', sans-serif;
            padding: 100px 20px 20px 20px;
        }

        .card-stat {
            border-radius: 16px;
            padding: 1.5rem;
            border: 1px solid #D5DEEF;
            background: #fff;
        }

        .card-stat h4 {
            font-weight: 600;
            margin-bottom: .5rem;
        }
    </style>
</head>

<body>

    <?php include('navbar_admin.php'); ?>

    <nav class="navbar navbar-light bg-white border-bottom shadow-sm d-flex d-md-none mb-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="<?= base_url('assets/img/logo.png') ?>" height="30" class="d-inline-block align-text-top">
                SMP SHANTI SATYA SUNDARA
            </a>
        </div>
    </nav>

    <h3 class="mb-4 text-center text-md-start">Dashboard Admin</h3>

    <div class="row g-3">
        <div class="col-6 col-md-3">
            <div class="card-stat text-center">
                <h4><?= esc($totalSiswa) ?></h4>
                <p class="text-muted mb-0">Total Siswa</p>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card-stat text-center">
                <h4><?= esc($totalGuru) ?></h4>
                <p class="text-muted mb-0">Total Guru</p>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card-stat text-center">
                <h4><?= esc($totalJadwal) ?></h4>
                <p class="text-muted mb-0">Total Jadwal</p>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card-stat text-center">
                <h4><?= esc($totalAkun) ?></h4>
                <p class="text-muted mb-0">Total Akun</p>
            </div>
        </div>
    </div>

    <nav class="navbar fixed-bottom bg-white border-top d-flex d-md-none">
        <div class="container-fluid d-flex justify-content-around">
            <a href="<?= base_url('admin/dashboard') ?>"
                class="text-center <?= service('uri')->getSegment(2) === 'dashboard' ? 'text-primary fw-bold' : 'text-dark' ?>">
                <i class="bi bi-speedometer2"></i><br><small>Dashboard</small>
            </a>
            <a href="<?= base_url('admin/jadwal') ?>"
                class="text-center <?= service('uri')->getSegment(2) === 'jadwal' ? 'text-primary fw-bold' : 'text-dark' ?>">
                <i class="bi bi-calendar-week"></i><br><small>Jadwal</small>
            </a>
            <a href="<?= base_url('admin/siswa') ?>"
                class="text-center <?= service('uri')->getSegment(2) === 'siswa' ? 'text-primary fw-bold' : 'text-dark' ?>">
                <i class="bi bi-people-fill"></i><br><small>Siswa</small>
            </a>
            <a href="<?= base_url('admin/guru') ?>"
                class="text-center <?= service('uri')->getSegment(2) === 'guru' ? 'text-primary fw-bold' : 'text-dark' ?>">
                <i class="bi bi-person-badge-fill"></i><br><small>Guru</small>
            </a>
            <a href="<?= base_url('logout') ?>" class="text-center text-danger">
                <i class="bi bi-box-arrow-right"></i><br><small>Logout</small>
            </a>
        </div>
    </nav>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>