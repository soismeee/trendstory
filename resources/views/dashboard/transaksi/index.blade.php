@extends('dashboard.layout.main')
@section('container')
@section('css')
<!-- Datatables css -->
<link href="/assets/css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css" />
<link href="/assets/css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css" />
@endsection

    <div class="content">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <form class="d-flex">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-light" id="dash-daterange">
                                <span class="input-group-text bg-primary border-primary text-white">
                                    <i class="mdi mdi-calendar-range font-13"></i>
                                </span>
                            </div>
                        </form>
                    </div>
                    <h4 class="page-title">Data Transaksi</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-xl-12 col-lg-6">
                <div class="row">
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
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th width="10%">No</th>
                                        {{-- <th width="20%">Nama</th> --}}
                                        <th width="20%">No Pesanan</th>
                                        <th width="10%">Jumlah</th>
                                        <th width="20%">Tanggal</th>
                                        <th width="20%">Total Bayar</th>
                                        <th width="20%">Bukti Bayar</th>
                                        <th width="10%">Status</th>
                                        <th width="10%">#</th>
                                    </tr>
                                </thead>
                            
                                <tbody>
                                    @foreach ($transaksi as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            {{-- <td>{{ $item->user->name }}</td> --}}
                                            <td>{{ $item->no_transaksi }}</td>
                                            <td>{{ $item->jumlah }}</td>
                                            <td>{{ date('d M Y', strtotime($item->created_at)) }}</td>
                                            <td>Rp. {{ number_format($item->nominal_bayar, 0, ',', '.') }}</td>
                                            <td>
                                                @if ($item->bukti_bayar == null)
                                                    Belum bayar
                                                @else
                                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#buktiBayar-{{ $item->id }}">Lihat</button>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->status == 0)
                                                    <span class="badge bg-info text-light">Order</span>
                                                @elseif($item->status == 1)
                                                    <span class="badge bg-warning text-light">Pendding</span>
                                                @elseif($item->status == 2)
                                                    <span class="badge bg-success text-light">Terima</span>
                                                @elseif($item->status == 3)
                                                    <span class="badge bg-danger text-light">Batal</span>
                                                @elseif($item->status == 4)
                                                    <span class="badge bg-dark text-light">Selesai</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->bukti_bayar == null)
                                                    <button class="btn btn-success btn-sm" disabled>Pesanan Baru</button>
                                                @elseif ($item->status == 4)
                                                    <button class="btn btn-success btn-sm" disabled>Selesai</button>
                                                @else    
                                                <div class="btn-group">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info dropdown-toggle text-white arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="mdi mdi-label font-16"></i>
                                                            <i class="mdi mdi-chevron-down"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <span class="dropdown-header">Aksi:</span>
                                                            <a type="button" class="dropdown-item text-info" data-bs-toggle="modal" data-bs-target="#prosesPesanan-{{ $item->id }}">Proses</a>
                                                            <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalhapuspbf-{{ $item->id }}">Hapus</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- End Content -->

    {{-- proses transaksi --}}
    @foreach ($transaksi as $data)
    <div id="prosesPesanan-{{ $data->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Proses Transaksi</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form action="/dashboard/transaksi_proses/{{ $data->id }}" method="post">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="form-floating mb-3 col-md-6">
                                <input type="text" class="form-control" id="floatingInput" value="{{ $data->user->name }}" readonly/>
                                <label for="floatingInput">Pelanggan</label>
                            </div>

                            <div class="form-floating mb-3 col-md-6">
                                <input type="text" class="form-control" id="floatingInput" value="{{ $data->jumlah }}" readonly/>
                                <label for="floatingInput">Jumlah Pesanan</label>
                            </div>
                        </div>

                        <label>Proses pesanan ini!!</label>
                        <div class="form-floating">
                            <select class="form-select" id="floatingSelectGrid" name="status" aria-label="Floating label select example">
                                <option selected>Pilih Proses</option>
                                <option {{ $data->status == "1" ? 'selected' : '' }} value="1">Pendding</option>
                                <option {{ $data->status == "2" ? 'selected' : '' }} value="2">terima</option>
                                <option {{ $data->status == "3" ? 'selected' : '' }} value="3">Batal</option>
                            </select>
                            <label for="floatingSelectGrid">Status pesanan</label>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    {{-- bukti transaksi --}}
    @foreach ($transaksi as $data)
    <div id="buktiBayar-{{ $data->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Bukti Pembayaran</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                    <div class="modal-body">
                        <img src="/buktibayar/{{ $data->bukti_bayar }}" width="450px" height="auto">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Tutup</button>
                    </div>
            </div>
        </div>
    </div>
    @endforeach

    @section('js')
    <!-- Datatables js -->
    <script src="/assets/js/vendor/jquery.dataTables.min.js"></script>
    <script src="/assets/js/vendor/dataTables.bootstrap5.js"></script>
    <script src="/assets/js/vendor/dataTables.responsive.min.js"></script>
    <script src="/assets/js/vendor/responsive.bootstrap5.min.js"></script>

    <!-- Datatable Init js -->
    <script src="/assets/js/pages/demo.datatable-init.js"></script>
@endsection

@endsection

