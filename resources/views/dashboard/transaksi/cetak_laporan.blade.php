<!DOCTYPE html>
<html>

<head>
    <title>{{ $title }}</title>
</head>

<body>
    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #3c3c3c;
            padding: 3px 8px;

        }

        .tengah {
            text-align: center;
        }
    </style>
    <h2 class='tengah'>TREND STORY</h2>
    <h3 class='tengah'>Laporan Pesanan</h3>
    <br />
    <p style="margin-left: 40px">Tanggal Cetak {{ date('d/m/Y', strtotime(now())) }}</p>
    <table>
        <tr>
            <th colspan="8">Peroide {{ date('d F Y', strtotime($bulan)) }}</th>
        </tr>
        <tr>
            <th align="left" width="3%">No</th>
            <th align="left" width="10%">No Pesanan</th>
            <th align="left" width="10%">Nama Customer</th>
            <th align="left" width="15%">Produk</th>
            <th align="left" width="10%">Tgl Pesan</th>
            <th align="left" width="10%">Admin</th>
            <th align="left" width="10%">Jumlah</th>
            <th align="left" width="15%">Bayar</th>
        </tr>
        @foreach ($pesanan as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->no_transaksi }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->product->nama }}</td>
                <td>{{ date('d M Y', strtotime($item->created_at)) }}</td>
                <td>{{ $item->karyawan }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>Rp. {{ number_format($item->nominal_bayar, 0, ',', '.') }}</td>
                <?php $nilai += $item->jumlah; ?>
                <?php $bayar += $item->nominal_bayar; ?>
            </tr>
        @endforeach
        <tr>
            <td colspan="6" style="text-align: right"><strong>Grand Total</strong></td>
            <td><strong>{{ $nilai }} Barang</strong></td>
            <td><strong>Rp. {{ number_format($bayar, 0, ',', '.') }}</strong></td>
        </tr>
    </table>
</body>
<script>
    print()
</script>

</html>
