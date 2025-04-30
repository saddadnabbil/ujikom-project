<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Peminjaman</title>
    <style>
        body {
            font-family: sans-serif;
        }
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            font-size: 12px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Data Peminjaman Buku</h2>

    <table>
        <thead>
            <tr>
                <th>ID Pinjam</th>
                <th>Nama Anggota</th>
                <th>Lama Pinjam (hari)</th>
                <th>Nominal Denda</th>
                <th>Petugas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjaman as $item)
                <tr>
                    <td>{{ $item->id_pinjam }}</td>
                    <td>{{ $item->anggota->nama ?? '-' }}</td>
                    <td>{{ $item->lama_pinjam }}</td>
                    <td>Rp {{ number_format($item->nominal_denda, 0, ',', '.') }}</td>
                    <td>{{ $item->user->name ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
