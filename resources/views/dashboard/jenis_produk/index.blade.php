@extends('dashboard.layout.main')
@section('container')

    @section('css')
        <!-- Datatables css -->
        <link href="/assets/css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css" />
    @endsection

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
                    <h4 class="page-title">Data Jenis Produk</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12 mb-3">
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#tambahjp"><i
                        class='uil uil-plus'></i> Tambah Jenis Produk</button>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-6">
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
                                    <th width="5%">No</th>
                                    <th width="80%">Jenis Produk</th>
                                    <th width="15%">#</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($jenis_produk as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editjp-{{ $item->id }}"><i class="mdi mdi-archive font-16"></i></button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalhapuspbf-{{ $item->id }}"><i class="mdi mdi-delete-variant font-16"></i></button>
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

    <!-- Modal tambah jenis produk -->
    <div id="tambahjp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="info-header-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-info">
                    <h4 class="modal-title" id="info-header-modalLabel">Form input Jenis Produk baru</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form action="/dashboard/jenis_products" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="floatingInput" value="{{ old('name') }}" name="name" placeholder="Masukan nama jenis produk" />
                            <label for="floatingInput">Nama Jenis Produk</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    {{-- ######################################################################################################################################## --}}
    {{-- modal tamplan edit data --}}
    @foreach ($jenis_produk as $data)
        <!-- Modal edit jenis produk -->
        <div id="editjp-{{ $data->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="info-header-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-info">
                        <h4 class="modal-title" id="info-header-modalLabel">Form edit data Jenis Produk</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <form action="/dashboard/jenis_products/{{ $data->id }}" method="post">
                        @method('put')
                        @csrf
                        <div class="modal-body">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="floatingInput" value="{{ old('name', $data->name) }}" name="name" placeholder="Masukan nama jenis produk" />
                                <label for="floatingInput">Nama Jenis Produk</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-info">Ubah Data</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    @endforeach

    {{-- modal hapus jenis produk --}}
    @foreach ($jenis_produk as $data)
        <div id="modalhapuspbf-{{ $data->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body p-4">
                        <div class="text-center">
                            <form action="/dashboard/jenis_products/{{ $data->id }}" method="post">
                                @method('delete')
                                @csrf
                                <i class="dripicons-warning h1 text-warning"></i>
                                <h4 class="mt-2">Peringatan!!!</h4>
                                <p class="mt-3">Apakah anda yakin ingin menghapus data Jenis Produk ini?</p>
                                <button type="submit" class="btn btn-danger my-2">Hapus</button>
                                <button type="button" class="btn btn-warning my-2" data-bs-dismiss="modal">Batal</button>
                            </form>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
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
