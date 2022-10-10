@extends('dashboard.layout.main')
@section('container')


    <!-- Datatables css -->
    <link href="/assets/css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css" />
    <!-- Start Content-->
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
                    <h4 class="page-title">Data Penjualan</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12 col-lg-6">
                <div class="col mb-3">
                    <a href="/dashboard/barang_masuks/create" class="btn btn-primary"> + Tambah Barang</a>
                </div>

                @if (session()->has('success'))
                    <div class="alert alert-success col-lg-12" role="alert">
                        {{ session('success') }}
                    </div>
                @elseif (session()->has('edit'))
                    <div class="alert alert-warning col-lg-12" role="alert">
                        {{ session('edit') }}
                    </div>
                @elseif (session()->has('hapus'))
                    <div class="alert alert-danger col-lg-12" role="alert">
                        {{ session('hapus') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="20%">No barang</th>
                                    <th width="20%">Jumlah</th>
                                    <th width="25%">karyawan</th>
                                    <th width="25%">Tanggal</th>
                                    <th width="5%">#</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($barang_masuk as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->no_bm }}</td>
                                        <td>{{ $item->total_bm }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ date('d M Y', strtotime($item->tanggal_bm)) }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success dropdown-toggle arrow-none"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-label font-16"></i>
                                                    <i class="mdi mdi-chevron-down"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <span class="dropdown-header">Aksi:</span>
                                                    @if (auth()->user()->role > 1)
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#edit_barang_masuk-{{ $item->id }}" class="dropdown-item text-warning">Edit</a>
                                                   @endif
                                                    <a href="/dashboard/info_barang_masuk/{{ $item->id }}" class="dropdown-item">Lihat</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div>
    <!-- container -->
    
    @foreach ($barang_masuk as $data)
    <div id="edit_barang_masuk-{{ $data->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Edit barang masuk</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form action="/dashboard/barang_masuks/{{ $data->id }}" method="post">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        @foreach (App\Models\DetailBarangMasuk::where('bm_id', $data->id)->get() as $item)
                        <div class="row g-2">
                            <div class="form-floating mb-3 col-md-6">
                                <input type="text" class="form-control" id="floatingInput" value="{{ $item->product->nama }}" />
                                <input type="hidden" name="product[]" value="{{ $item->id }}">
                                <label for="floatingInput">Produk</label>
                            </div>

                            <div class="form-floating mb-3 col-md-6">
                                <input type="text" class="form-control" id="floatingInput" name="jumlah[]" value="{{ $item->jumlah }}" />
                                <input type="hidden" name="jumlah_old[]" value="{{ $item->jumlah }}">
                                <label for="floatingInput">Jumlah</label>
                            </div>
                        </div>
                        @endforeach
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
