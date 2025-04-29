<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Faktur #{{ $faktur->no_faktur }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.5;
            margin: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h2 {
            margin: 0;
        }

        .info-section {
            margin-bottom: 20px;
        }

        .info-table, .items-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 5px;
        }

        .items-table th, .items-table td {
            border: 1px solid #000;
            padding: 8px;
        }

        .items-table th {
            background-color: #f0f0f0;
            text-align: left;
        }

        .total-section {
            margin-top: 20px;
            width: 100%;
            text-align: right;
        }

        .total-section table {
            width: 300px;
            float: right;
        }

        .total-section td {
            padding: 5px;
        }

        .footer {
            margin-top: 40px;
            font-size: 10px;
            text-align: center;
            color: #666;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>{{ $faktur->perusahaan->nama_perusahaan ?? 'Nama Perusahaan' }}</h2>
        <p>{{ $faktur->perusahaan->alamat ?? 'Alamat Perusahaan' }}</p>
        <p><strong>Faktur Penjualan</strong></p>
    </div>

    <div class="info-section">
        <table class="info-table">
            <tr>
                <td><strong>No Faktur</strong></td>
                <td>: {{ $faktur->no_faktur }}</td>
                <td><strong>Tanggal</strong></td>
                <td>: {{ date('d/m/Y', strtotime($faktur->tanggal_faktur)) }}</td>
            </tr>
            <tr>
                <td><strong>Customer</strong></td>
                <td>: {{ $faktur->customer->nama_customer ?? '-' }}</td>
                <td><strong>Jatuh Tempo</strong></td>
                <td>: {{ date('d/m/Y', strtotime($faktur->due_date)) }}</td>
            </tr>
            <tr>
                <td><strong>Metode Bayar</strong></td>
                <td colspan="3">: {{ ucfirst($faktur->metode_bayar) }}</td>
            </tr>
        </table>
    </div>

    <table class="items-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($faktur->detailFakturs as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->produk->nama_produk ?? '-' }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->qty * $item->price, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        <table>
            <tr>
                <td><strong>Total</strong></td>
                <td>Rp {{ number_format($faktur->total, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>PPN ({{ $faktur->ppn }}%)</strong></td>
                <td>Rp {{ number_format($faktur->total * ($faktur->ppn / 100), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Grand Total</strong></td>
                <td><strong>Rp {{ number_format($faktur->grand_total, 0, ',', '.') }}</strong></td>
            </tr>
            <tr>
                <td><strong>DP</strong></td>
                <td>Rp {{ number_format($faktur->dp, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Dokumen ini dicetak secara otomatis. Harap tidak menandatangani atau mengubah tanpa izin.</p>
    </div>

</body>
</html>
