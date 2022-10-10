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
            <h4 class="page-title">Data Produk</h4>
        </div>
    </div>
</div>
<!-- end page title -->
@can('karyawan')
    <div class="row">
        <div class="col-12 mb-3">
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#tambahProduk"><i
                    class='uil uil-plus'></i> Tambah Produk</button>
        </div>
    </div>
@endcan

<div class="row">
    <div class="col-xl-12 col-lg-6">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Selamat, </strong> {{ session('success') }}
            </div>
        @elseif (session()->has('edit'))
            <div class="alert alert-primary alert-dismissible bg-primary text-white border-0 fade show" role="alert">
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
                            <th width="10%">Nama Produk</th>
                            <th width="10%">Jenis Produk</th>
                            <th width="10%">Stok</th>
                            <th width="10%">Harga</th>
                            <th width="10%">Cover</th>
                            <th width="10%">Status</th>
                            @can('karyawan')
                                <th width="5%">#</th>
                            @endcan
                        </tr>
                    </thead>


                    <tbody>
                        @foreach ($products as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>@if (App\Models\JenisProduct::find($item->jenis_id) == null )
                                    <span class="text-danger">tidak ada</span>
                                @else
                                    {{ $item->jenisproduct->name }}</td>
                                @endif
                                <td>{{ $item->stok }}</td>
                                <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td>
                                    @if ($item->cover == null)
                                        <img src="/assets/images/noavailable.jpg" width="40px">
                                        <br>
                                        <h6>no cover</h6>
                                    @else
                                        <img src="/coverproduct/{{ $item->cover }}" width="40px">
                                    @endif
                                <td>
                                    @if ($item->status == 1)
                                    <span class="text-warning"><strong>Segera Launching</strong></span>
                                    @elseif ($item->status == 2)
                                        <span class="text-success"><strong>Launching</strong></span>
                                    @elseif ($item->status == 3)
                                        <span class="text-info"><strong>Terbaru</strong></span>
                                    @elseif ($item->status == 4)
                                        <span class="text-danger"><strong>Arsip</strong></span>
                                    @endif
                                </td>
                                @can('karyawan')
                                    <td>
                                        <div class="btn-group">
                                            <a href="/dashboard/products/{{ $item->id }}" class="btn btn-success"><i class="mdi mdi-image-plus font-16"></i></a>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-warning dropdown-toggle text-white arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-label font-16"></i>
                                                    <i class="mdi mdi-chevron-down"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <span class="dropdown-header">Aksi:</span>
                                                    <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editProduk-{{ $item->id }}">Edit</a>
                                                    <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalhapuspbf-{{ $item->id }}">Hapus</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div>
<!-- end row -->

<!-- Modal tambah produk -->
<div id="tambahProduk" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="info-header-modalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-info">
                <h4 class="modal-title" id="info-header-modalLabel">Form input Produk baru</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="/dashboard/products" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-floating mb-2">
                        <input type="hidden" name="kd_barang" value="{{ $kd->kodes }}">
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="floatingNamaProduk"
                            value="{{ old('nama') }}" name="nama" placeholder="Masukan nama produk" />
                        <label for="floatingNamaProduk">Nama Produk</label>
                    </div>

                    <div class="row g-2 mb-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <select class="form-select @error('jenis_id') is-invalid @enderror" id="floatingJenisProduk" name="jenis_id">
                                    <option>Pilih Jenis Produk</option>
                                    @foreach ($jenis_produk as $jp)
                                        <option {{ old('jenis_id') == $jp->id ? 'selected' : '' }} value="{{ $jp->id }}">{{ $jp->name }}</option>
                                    @endforeach
                                </select>
                                <label for="floatingJenisProduk">Jenis Produk</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <select class="form-select @error('status') is-invalid @enderror" name="status" id="floatingStatus" aria-label="Floating label select example">
                                    <option>Pilih Status Produk</option>
                                    <option {{ old('status') == 1 ? 'selected' : '' }} value="1">Segera Launching</option>
                                    <option {{ old('status') == 2 ? 'selected' : '' }} value="2">Launching</option>
                                    <option {{ old('status') == 3 ? 'selected' : '' }} value="3">Terbaru</option>
                                    <option {{ old('status') == 4 ? 'selected' : '' }} value="4">Arsip</option>
                                </select>
                                <label for="floatingStatus">Status</label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-2 mb-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="number" min="0" name="stok" class="form-control @error('stok') is-invalid @enderror" id="floatingStok" value="{{ old('stok') }}"/>
                                <label for="floatingStok">Stok</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('stok') is-invalid @enderror" name="satuan" placeholder="Masukan satuan barang" value="{{ old('satuan') }}"/>
                                <label for="floatingSatuan">Satuan barang</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating mb-2">
                        <input type="number" class="form-control @error('harga') is-invalid @enderror" id="floatinghargaProduk"
                            value="{{ old('harga') }}" name="harga" placeholder="Masukan harga produk" />
                        <label for="floatinghargaProduk">Harga Produk</label>
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control @error('detail') is-invalid @enderror" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px" value="{{ old('detail') }}" name="detail">{{ old('detail') }}</textarea>
                        <label for="floatingTextarea">Detail Produk</label>
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

@foreach ($products as $data)
    <!-- Modal edit produk -->
    <div id="editProduk-{{ $data->id }}" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="info-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-info">
                    <h4 class="modal-title" id="info-header-modalLabel">Form edit data Produk</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form action="/dashboard/products/{{ $data->id }}" method="post">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="floatingNamaProduk"
                                value="{{ old('nama', $data->nama) }}" name="nama" placeholder="Masukan nama produk" />
                            <label for="floatingNamaProduk">Nama Produk</label>
                        </div>

                        <div class="row g-2 mb-2">
                            <div class="col-md">
                                <div class="form-floating">
                                    <select class="form-select @error('jenis_id') is-invalid @enderror" id="floatingJenisProduk" name="jenis_id">
                                        <option>Pilih Jenis Produk</option>
                                        @foreach ($jenis_produk as $jp)
                                            <option {{ old('jenis_id', $data->jenis_id) == $jp->id ? 'selected' : '' }} value="{{ $jp->id }}">{{ $jp->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingJenisProduk">Jenis Produk</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating">
                                    <select class="form-select @error('status') is-invalid @enderror" name="status" id="floatingStatus" aria-label="Floating label select example">
                                        <option>Pilih Status Produk</option>
                                        <option {{ old('status', $data->status) == 1 ? 'selected' : '' }} value="1">Segera Launching</option>
                                        <option {{ old('status', $data->status) == 2 ? 'selected' : '' }} value="2">Launching</option>
                                        <option {{ old('status', $data->status) == 3 ? 'selected' : '' }} value="3">Terbaru</option>
                                        <option {{ old('status', $data->status) == 4 ? 'selected' : '' }} value="4">Arsip</option>
                                    </select>
                                    <label for="floatingStatus">Status</label>
                                </div>
                            </div>
                        </div>
    
                        <div class="row g-2 mb-2">
                            <div class="col-md">
                                <div class="form-floating">
                                    <input type="number" min="0" name="stok" class="form-control @error('stok') is-invalid @enderror" id="floatingStok" value="{{ old('stok', $data->stok) }}"/>
                                    <label for="floatingStok">Stok</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('stok') is-invalid @enderror" name="satuan" placeholder="Masukan satuan barang" value="{{ old('satuan', $data->satuan) }}"/>
                                    <label for="floatingSatuan">Satuan barang</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-floating mb-2">
                            <input type="number" class="form-control @error('harga') is-invalid @enderror" id="floatinghargaProduk"
                                value="{{ old('harga', $data->harga) }}" name="harga" placeholder="Masukan harga produk" />
                            <label for="floatinghargaProduk">Harga Produk</label>
                        </div>

                        <div class="form-floating">
                            <textarea class="form-control @error('detail') is-invalid @enderror" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px" value="{{ old('detail', $data->detail) }}" name="detail">{{ $data->detail }}</textarea>
                            <label for="floatingTextarea">Detail Produk</label>
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

@foreach ($products as $data)
    <div id="modalhapuspbf-{{ $data->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <form action="/dashboard/products/{{ $data->id }}" method="post">
                            @method('delete')
                            @csrf
                            <i class="dripicons-warning h1 text-warning"></i>
                            <h4 class="mt-2">Peringatan!!!</h4>
                            <p class="mt-3">Apakah anda yakin ingin menghapus data Produk ini?</p>
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
