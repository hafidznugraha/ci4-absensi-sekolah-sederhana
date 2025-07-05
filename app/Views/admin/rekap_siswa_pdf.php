<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #222;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background: #eee;
        }

        h3 {
            margin-bottom: 12px;
        }
    </style>
</head>

<body>
    <h3>Rekap Data Siswa</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIS</th>
                <th>Email</th>
                <th>Kata Sandi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($siswa as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($row['nama']) ?></td>
                    <td><?= esc($row['nis']) ?></td>
                    <td><?= esc($row['email']) ?></td>
                    <td><?= esc($row['password']) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>