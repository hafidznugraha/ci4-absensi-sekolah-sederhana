<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Rekap Data Guru</title>
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
    <h3>Rekap Data Guru</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Kata Sandi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($guru as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($row['nama']) ?></td>
                    <td><?= esc($row['email']) ?></td>
                    <td><?= esc($row['password']) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>