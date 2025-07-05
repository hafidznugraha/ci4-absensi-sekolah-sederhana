<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Jadwal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/x-icon">
    <style>
        body {
            background-color: #F0F3FA;
            font-family: 'Segoe UI', sans-serif;
            padding-top: 16px;
        }

        @media (min-width: 768px) {
            body {
                padding-top: 72px !important;
            }
        }

        .card {
            border-radius: 16px;
            border: 1px solid #D5DEEF;
            background-color: white;
            padding: 20px;
        }

        .table thead {
            background-color: #628ECB;
            color: #fff;
        }

        input.form-control,
        select.form-select {
            box-shadow: none !important;
        }

        .btn-group-mobile {
            display: flex;
            flex-direction: row;
            gap: 8px;
        }

        .container {
            margin-bottom: 20px !important;
        }

        @media (max-width: 576px) {
            .btn-group-mobile {
                flex-direction: column;
                gap: 8px;
                width: 100%;
            }

            .btn-group-mobile .btn {
                width: 100%;
            }

            .container {
                padding-left: 12px !important;
                padding-right: 12px !important;
                margin-bottom: 85px !important;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand bg-white border-bottom shadow-sm
                d-none d-md-flex position-fixed top-0 start-0 end-0 px-4 py-2"
        style="z-index:1030">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <img src="<?= base_url('assets/img/logo.png') ?>" height="36" alt="Logo">
                <span class="fw-semibold text-primary">SMP SHANTI SATYA SUNDARA</span>
            </div>
            <div class="d-flex gap-4 text-center">
                <a href="<?= base_url('admin/dashboard') ?>"
                    class="nav-link text-dark <?= service('uri')->getSegment(2) === 'dashboard' ? 'fw-bold text-primary' : '' ?>">
                    <div><i class="bi bi-speedometer2"></i><br><small>Dashboard</small></div>
                </a>
                <a href="<?= base_url('admin/jadwal') ?>"
                    class="nav-link text-dark <?= service('uri')->getSegment(2) === 'jadwal' ? 'fw-bold text-primary' : '' ?>">
                    <div><i class="bi bi-calendar-week"></i><br><small>Jadwal</small></div>
                </a>
                <a href="<?= base_url('admin/siswa') ?>"
                    class="nav-link text-dark <?= service('uri')->getSegment(2) === 'siswa' ? 'fw-bold text-primary' : '' ?>">
                    <div><i class="bi bi-people-fill"></i><br><small>Siswa</small></div>
                </a>
                <a href="<?= base_url('admin/guru') ?>"
                    class="nav-link text-dark <?= service('uri')->getSegment(2) === 'guru' ? 'fw-bold text-primary' : '' ?>">
                    <div><i class="bi bi-person-badge-fill"></i><br><small>Guru</small></div>
                </a>
                <a href="<?= base_url('logout') ?>" class="nav-link text-danger">
                    <div><i class="bi bi-box-arrow-right"></i><br><small>Logout</small></div>
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-2">
        <div class="d-md-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-2 mb-md-0">Data Jadwal</h4>
            <div class="btn-group-mobile mt-2 mt-md-0">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    <i class="bi bi-plus-lg"></i> Tambah Jadwal
                </button>
            </div>
        </div>
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Hari</th>
                            <th>Mapel</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($jadwal as $j): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($j['hari']) ?></td>
                                <td><?= esc($j['mapel']) ?></td>
                                <td><?= esc($j['jam_mulai']) ?></td>
                                <td><?= esc($j['jam_selesai']) ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm"
                                        onclick="editJadwal(
                                            '<?= $j['id'] ?>',
                                            '<?= $j['hari'] ?>',
                                            '<?= $j['mapel'] ?>',
                                            '<?= $j['jam_mulai'] ?>',
                                            '<?= $j['jam_selesai'] ?>'
                                        )"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEdit">
                                        Edit
                                    </button>
                                    <a href="<?= base_url('admin/jadwal/hapus/' . $j['id']) ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus?')">
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="<?= base_url('admin/jadwal/tambah') ?>" method="post" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jadwal</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Hari</label>
                        <select name="hari" class="form-select" required>
                            <option value="">Pilih Hari</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mapel</label>
                        <input type="text" name="mapel" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jam Mulai</label>
                        <input type="time" name="jam_mulai" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jam Selesai</label>
                        <input type="time" name="jam_selesai" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="<?= base_url('admin/jadwal/update') ?>" method="post" class="modal-content">
                <input type="hidden" name="id" id="edit-id">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Jadwal</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Hari</label>
                        <select name="hari" id="edit-hari" class="form-select" required>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mapel</label>
                        <input type="text" name="mapel" id="edit-mapel" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="edit-jam_mulai" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jam Selesai</label>
                        <input type="time" name="jam_selesai" id="edit-jam_selesai" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
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

    <script>
        function editJadwal(id, hari, mapel, mulai, selesai) {
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-hari').value = hari;
            document.getElementById('edit-mapel').value = mapel;
            document.getElementById('edit-jam_mulai').value = mulai;
            document.getElementById('edit-jam_selesai').value = selesai;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>