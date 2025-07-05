<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absen Hari Ini</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/x-icon">
    <style>
        body {
            background-color: #F0F3FA;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .card {
            border: 1px solid #D5DEEF;
            border-radius: 16px;
            padding: 24px;
            max-width: 500px;
            width: 90%;
            background: white;
        }

        .btn-primary {
            background-color: #628ECB;
            border-color: #628ECB;
        }

        .btn-primary:hover {
            background-color: #395886;
            border-color: #395886;
        }

        .form-control,
        .form-select {
            box-shadow: none !important;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center">

    <div class="card">
        <h4 class="text-center mb-4">Absensi Siswa</h4>
        <p><strong>Nama:</strong> <?= session()->get('nama') ?></p>
        <p><strong>Tanggal:</strong> <?= date('d-m-Y') ?></p>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php elseif (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('siswa/submit') ?>" method="post" enctype="multipart/form-data" onsubmit="return cekValidasi();">
            <div class="mb-3">
                <label for="status" class="form-label">Status Kehadiran:</label>
                <select name="status" id="status" class="form-select" required onchange="toggleBukti()">
                    <option value="">-- Pilih --</option>
                    <option value="hadir">Hadir</option>
                    <option value="izin">Izin</option>
                    <option value="sakit">Sakit</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan (Opsional):</label>
                <textarea name="keterangan" class="form-control" rows="2" placeholder="Tulis keterangan jika ada..."></textarea>
            </div>

            <div class="mb-3 d-none" id="uploadBukti">
                <label for="bukti" class="form-label">Unggah Bukti (PDF / Gambar, maks 2MB):</label>
                <input type="file" name="bukti" id="bukti" class="form-control" accept=".pdf,image/*">
            </div>

            <button type="submit" class="btn btn-primary w-100">Kirim Absensi</button>
        </form>
    </div>

    <script>
        function toggleBukti() {
            const status = document.getElementById("status").value;
            const buktiBox = document.getElementById("uploadBukti");
            if (status === "izin" || status === "sakit") {
                buktiBox.classList.remove("d-none");
            } else {
                buktiBox.classList.add("d-none");
            }
        }

        function cekValidasi() {
            const status = document.getElementById("status").value;
            const inputBukti = document.getElementById("bukti");

            if (status === "izin" || status === "sakit") {
                if (!inputBukti.files.length) {
                    alert("Silakan unggah bukti terlebih dahulu.");
                    return false;
                }

                const file = inputBukti.files[0];
                const maxSize = 2 * 1024 * 1024; // 2MB

                if (file.size > maxSize) {
                    alert("Ukuran file maksimal 2MB.");
                    return false;
                }
            }

            return true;
        }
    </script>
</body>

</html>