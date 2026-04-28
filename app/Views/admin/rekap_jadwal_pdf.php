<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Rekap Jadwal</title>

    <style>
        body {
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            font-size: 13px;
        }

        h3 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }

        th,
        td {
            border: 1px solid #222;
            padding: 7px 4px;
            text-align: left;
        }

        th {
            background: #eee;
        }
    </style>
</head>

<body>

    <h3>Rekap Jadwal Pelajaran</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Hari</th>
                <th>Mapel</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
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
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>