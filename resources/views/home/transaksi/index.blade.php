@extends('home.layout.main')
@section('container')
    <!-- Start Content-->
    <div class="container-fluid">
                        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Transaksi</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Transaksi</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-12">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show"
                        role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Selamat, </strong> {{ session('success') }}
                    </div>
                @elseif (session()->has('edit'))
                    <div class="alert alert-primary alert-dismissible bg-primary text-white border-0 fade show"
                        role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        {{ session('edit') }}
                    </div>
                @elseif (session()->has('hapus'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Berhasil, </strong> {{ session('hapus') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-centered mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nomor Pesanan</th>
                                        <th>Nama barang</th>
                                        <th>Jumlah</th>
                                        <th>Total Bayar</th>
                                        <th>Tanggal</th>
                                        <th>Metode Bayar</th>
                                        <th>Status</th>
                                        <th style="width: 125px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaksi as $ts)
                                        <tr>
                                            <td><a href="#" class="text-body fw-bold">{{ $ts->no_transaksi }}</a> </td>
                                            <td><h5>{{ $ts->product->nama }}</h5></td>
                                            <td><h5>{{ $ts->jumlah }}</h5></td>
                                            <td>
                                                <h5>Rp. {{ number_format($ts->nominal_bayar, 0, ',', '.') }}</h5>
                                                Harga satuan Rp. {{ number_format($ts->product->harga, 0, ',', '.') }}
                                            </td>
                                            <td>
                                                {{ date('d F Y', strtotime($ts->created_at)) }} <br>
                                                Perkiraan sampai  {{ date('d/m/Y', strtotime('+5 day', strtotime($ts->created_at))) }}
                                            </td>
                                            <td>
                                                @if ($ts->bayar_id == null)
                                                <span class="badge bg-danger text-white">Belum bayar</span>
                                                @elseif($ts->bukti_bayar)
                                                <strong>{{ $ts->metodebayar->nama_metode }}</strong> <br />
                                                <span class="badge bg-success text-white">Sudah bayar</span>
                                                @else
                                                <strong>{{ $ts->metodebayar->nama_metode }}</strong> <br />
                                                <a href="javascript:void(0);" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#kirimBuktiPembayaran-{{ $ts->id }}"> Kirim bukti</a>
                                                    
                                                @endif
                                            </td>
                                            <td>
                                                @if ($ts->status == 0)
                                                    <span class="badge bg-info text-white">Order</span>
                                                @elseif($ts->status == 1)
                                                    <span class="badge bg-warning text-white">Pendding</span>
                                                @elseif($ts->status == 2)
                                                    <span class="badge bg-success text-white">Terima</span>
                                                @elseif($ts->status == 3)
                                                    <span class="badge bg-danger text-white">Batal</span>
                                                @elseif($ts->status == 4)
                                                    <span class="badge bg-dark text-white">Selesai</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($ts->status == 0)
                                                <div class="btn-group">
                                                    <a href="javascript:void(0);" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#bayarPesanan-{{ $ts->id }}"> <i class="mdi mdi-cash"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editPesanan-{{ $ts->id }}"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalhapusPesanan-{{ $ts->id }}"> <i class="mdi mdi-book-cancel-outline"></i></a>
                                                </div>
                                                @elseif ($ts->status == 1)
                                                <div class="btn-group">
                                                    <a href="javascript:void(0);" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editPesanan-{{ $ts->id }}"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalhapusPesanan-{{ $ts->id }}"> <i class="mdi mdi-book-cancel-outline"></i></a>
                                                </div>
                                                @elseif ($ts->status == 3)
                                                <span class="badge bg-danger text-light">Cancel</span>
                                                @elseif ($ts->status == 4)
                                                <button class="btn btn-dark" disabled>Diterima</button>
                                                @else
                                                <a href="javascript:void(0);" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalterimaPesanan-{{ $ts->id }}"><i class="mdi mdi-progress-check"></i> Terima</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row --> 

    <!-- Modal bayar pesanan produk -->
    @foreach ($transaksi as $data)
        <div id="bayarPesanan-{{ $data->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="info-header-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-info">
                        <h4 class="modal-title" id="info-header-modalLabel">Bayar pesanan anda</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <form action="/home/update_bayar/{{ $data->id }}" method="post">
                        @method('put')
                        @csrf
                        <div class="modal-body">
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" id="floatingInput" value="{{ old('no_transaksi', $data->no_transaksi) }}" disabled />
                                <label for="floatingInput">Nomor Pesanan</label>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="form-floating">
                                <select name="bayar_id" class="form-select">
                                    <option selected disabled>Pilih Metode Pembayaran</option>
                                    @foreach ($metodebayar as $mb)
                                        <option value="{{ $mb->id }}">
                                            {{ $mb->nama_metode }} -
                                            <h4><strong>{{ $mb->no_rekening }}</strong></h4>
                                        </option>
                                    @endforeach
                                </select>
                                <label for="floatingInput">Metode Pembayaran</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success text-white">Bayar Sekarang</button>
                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    @endforeach 
    
    {{-- Modal bukti pembayaran --}}
    @foreach ($transaksi as $data)
        <div id="kirimBuktiPembayaran-{{ $data->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="info-header-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-info">
                        <h4 class="modal-title" id="info-header-modalLabel">Bayar pesanan anda</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <form action="/home/kirim_bukti/{{ $data->id }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="modal-body">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInput" value="{{ old('no_transaksi', $data->no_transaksi) }}" disabled />
                                <label for="floatingInput">Nomor Pesanan</label>
                            </div>
                        </div>
                        <div class="modal-body">
                            <input type="file" class="form-control" name="bukti_bayar">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success text-white">Bayar Sekarang</button>
                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    @endforeach 
        
    <!-- Modal edit pesanan produk -->
    @foreach ($transaksi as $data)
        <div id="editPesanan-{{ $data->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="info-header-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-info">
                        <h4 class="modal-title" id="info-header-modalLabel">Ubah data pesanan anda</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <form action="/home/update_transaksi/{{ $data->id }}" method="post">
                        @method('put')
                        @csrf
                        <div class="modal-body">
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" id="floatingInput" value="{{ old('no_transaksi', $data->no_transaksi) }}" disabled />
                                <label for="floatingInput">Nomor Pesanan</label>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('jumlah') is-invalid @enderror" id="floatingInput" value="{{ old('jumlah', $data->jumlah) }}" name="jumlah" />
                                <label for="floatingInput">Jumlah pesanan</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning text-white">Ubah Data</button>
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    @endforeach

    {{-- modal hapus pesanan produk --}}
    @foreach ($transaksi as $data)
        <div id="modalhapusPesanan-{{ $data->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body p-4">
                        <div class="text-center">
                            <form action="/home/batal_transaksi/{{ $data->id }}" method="post">
                                @method('put')
                                @csrf
                                <i class="dripicons-warning h1 text-warning"></i>
                                <h4 class="mt-2">Peringatan!!!</h4>
                                <p class="mt-3">Apakah anda yakin ingin membatalkan pesanan ini?</p>
                                <button type="submit" class="btn btn-danger my-2">Batal</button>
                                <button type="button" class="btn btn-warning my-2 text-white" data-bs-dismiss="modal">Batal</button>
                            </form>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    @endforeach

    {{-- modal terima pesanan produk --}}
    @foreach ($transaksi as $data)
        <div id="modalterimaPesanan-{{ $data->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body p-4">
                        <div class="text-center">
                            <form action="/home/terima_pesanan/{{ $data->id }}" method="post">
                                @method('put')
                                @csrf
                                <i class="dripicons-checkmark h1"></i>
                                <h4 class="mt-2">Selamat Pesanan anda sudah tiba</h4>
                                <p class="mt-3">Pastikan pesanan anda sudah sampai pada tujuan!</p>
                                <button type="submit" class="btn btn-success my-2">Ya, sudah</button>
                                <button type="button" class="btn btn-danger my-2" data-bs-dismiss="modal">Batal</button>
                            </form>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    @endforeach
        
    </div>
    <!-- container -->
@endsection
