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
    <h3 class='tengah'>Laporan Barang Masuk</h3>
    <br />
    <p style="margin-left: 40px">Tanggal Cetak {{ date('d/m/Y', strtotime(now())) }}</p>
    <table>
        <tr>
            <th colspan="7">Peroide {{ date('d F Y', strtotime($bulan)) }}</th>
        </tr>
        <tr>
            <th align="left" width="5%">No</th>
            <th align="left" width="20%">Kode Barang</th>
            <th align="left" width="15%">Nama Barang</th>
            <th align="left" width="10%">Stok awal</th>
            <th align="left" width="10%">Barang Masuk</th>
            <th align="left" width="10%">Barang Keluar</th>
            <th align="left" width="10%">Stok Akhir</th>
        </tr>

        @foreach ($barang as $item)

                    @if (App\Models\DetailBarangMasuk::where('product_id', $item->id)->whereBetween('created_at', [$hari, $bulan])->get()->count() == !null)
                        @foreach (App\Models\DetailBarangMasuk::where('product_id', $item->id)->whereBetween('created_at', [$hari, $bulan])->get() as $detail)
                            <?php $masuk += $detail->jumlah; ?>
                        @endforeach
                    @else
                        <?php $masuk = 0; ?>
                    @endif

                    @if (App\Models\Transaksi::where('product_id', $item->id)->whereBetween('created_at', [$hari, $bulan])->get()->count() == !null)
                    @else
                        @foreach (App\Models\Transaksi::where('product_id', $item->id)->whereBetween('created_at', [$hari, $bulan])->get() as $detail2)
                            <?php $keluar += $detail2->jumlah; ?>
                        @endforeach
                        <?php $keluar = 0; ?>
                    @endif
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->kd_barang }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->stok - $masuk }}</td>
                <td>
                    
                    {{ $masuk }}
                </td>
                <td>
                    
                    {{ $keluar }}
                </td>
                <td>{{ $item->stok }}</td>
            </tr>
        @endforeach
    </table>
</body>
<script>
    // print()
</script>

</html>
