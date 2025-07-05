<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Rekap Absensi <?= esc($hari) ?></title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 4px;
            text-align: center;
        }

        th {
            background: #eee;
        }

        h2,
        h4 {
            margin: 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>SMPN SWA BHUWANA PAKSA</h2>
    <h4>Rekap Absensi Guru: <?= esc($nama) ?></h4>
    <p style="text-align:center">Tanggal: <?= esc($hari) ?></p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Siswa</th>
                <th>NIS</th>
                <th>Waktu Absen</th>
                <th>Status</th>
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
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>