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
                    <h4 class="page-title">Data Karyawan</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-xl-12 col-lg-6">
                <div class="col mb-3">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahKaryawan"> + Tambah Karyawan</button>
                </div>
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
                                        <th width="20%">Nama</th>
                                        <th width="20%">Username</th>
                                        <th width="30%">Email</th>
                                        <th width="10%">Status</th>
                                        <th width="10%">#</th>
                                    </tr>
                                </thead>
                            
                            
                                <tbody>
                                    @foreach ($karyawan as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->username }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>@if ($item->aktif == 'aktif')
                                                    <span class="badge badge-success-lighten p-1">{{ $item->aktif }}</span>
                                                @else
                                                    <span class="badge badge-danger-lighten p-1">{{ $item->aktif }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editKaryawan-{{ $item->id }}"><i class="mdi mdi-archive font-16"></i></button>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapuskaryawan-{{ $item->id }}"><i class="mdi mdi-delete-variant font-16"></i></button>
                                                </div>
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

    <!-- Info Header Modal -->
    <div id="tambahKaryawan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="info-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-info">
                    <h4 class="modal-title" id="info-header-modalLabel">Tambah data pengguna</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form action="/dashboard/karyawans" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-2 mb-2">
                            <div class="form-floating col-md-6">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="floatingnama" name="name" value="{{ old('name') }}" placeholder="Nama lengkap" />
                                    <label for="floatingnama">Nama Lengkap</label>
                            </div>

                            <div class="form-floating col-md-6">
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="floatingusername" name="username" value="{{ old('username') }}" placeholder="Username" />
                                    <label for="floatingusername">Username</label>
                            </div>
                        </div>
                        <div class="row g-2 mb-2">
                            <div class="form-floating col-md-6">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingemail" name="email" value="{{ old('email') }}" placeholder="Email" />
                                <label for="floatingemail">Email address</label>
                            </div>
                            <div class="form-floating col-md-6">
                                <select class="form-select @error('aktif') is-invalid @enderror" name="aktif" id="floatingaktif" aria-label="Floating label select example">
                                    <option>Pilih Status karyawan</option>
                                    <option {{ old('aktif') == 'aktif' ? 'selected' : '' }} value="aktif">Aktif</option>
                                    <option {{ old('aktif') == 'non-aktif' ? 'selected' : '' }} value="non-aktif">Non Aktif</option>
                                </select>
                                <label for="floatingaktif">Status karyawan</label>
                            </div>
                        </div>
                        
                        <div class="form-floating">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" name="password" placeholder="Password" />
                            <label for="floatingPassword">Password</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Info Header Modal -->
    @foreach ($karyawan as $data)
    <div id="editKaryawan-{{ $data->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="info-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-info">
                    <h4 class="modal-title" id="info-header-modalLabel">Edit data pengguna</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form action="/dashboard/karyawans/{{ $data->id }}" method="post">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        <div class="row g-2 mb-2">
                            <div class="form-floating col-md-6">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="floatingnama" name="name" value="{{ old('name', $data->name) }}" placeholder="Nama lengkap" />
                                <label for="floatingnama">Nama Lengkap</label>
                            </div>

                            <div class="form-floating col-md-6">
                                <input type="text" class="form-control @error('username') is-invalid @enderror" id="floatingusername" name="username" value="{{ old('username', $data->username) }}" placeholder="Username" />
                                <label for="floatingusername">Username</label>
                            </div>
                        </div>

                        <div class="row g-2 mb-2">
                            <div class="form-floating col-md-6">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingemail" name="email" value="{{ old('email', $data->email) }}" placeholder="Email" />
                                <label for="floatingemail">Email address</label>
                            </div>
                            <div class="form-floating col-md-6">
                                <select class="form-select @error('aktif') is-invalid @enderror" name="aktif" id="floatingaktif" aria-label="Floating label select example">
                                    <option>Pilih Status karyawan</option>
                                    <option {{ old('aktif', $data->aktif) == 'aktif' ? 'selected' : '' }} value="aktif">Aktif</option>
                                    <option {{ old('aktif', $data->aktif) == 'non-aktif' ? 'selected' : '' }} value="non-aktif">Non Aktif</option>
                                </select>
                                <label for="floatingaktif">Status karyawan</label>
                            </div>
                        </div>
                        
                        <div class="form-floating">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" name="password" placeholder="Password" />
                            <label for="floatingPassword">Password</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->        
    @endforeach

    @foreach ($karyawan as $data)
        <div id="modalHapuskaryawan-{{ $data->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body p-4">
                        <div class="text-center">
                            <form action="/dashboard/karyawans/{{ $data->id }}" method="post">
                                @method('delete')
                                @csrf
                                <i class="dripicons-warning h1 text-warning"></i>
                                <h4 class="mt-2">Peringatan!!!</h4>
                                <p class="mt-3">Apakah anda yakin ingin menghapus data karyawan ini?</p>
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

