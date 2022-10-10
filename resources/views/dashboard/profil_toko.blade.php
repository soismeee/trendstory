@extends('dashboard.layout.main')
@section('container')
    <!-- Start Content-->
    <div class="container-fluid">

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
                    <h4 class="page-title">Profile User</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-xl-4 col-lg-5">
                <div class="card text-center">
                    <div class="card-body">

                        <h4 class="mb-0 mt-2">{{ auth()->user()->name }}</h4>
                        <p class="text-muted font-14">
                            {{ auth()->user()->username }}
                        </p>

                        <div class="text-start mt-3">
                            <h4 class="font-13 text-uppercase">Note :</h4>
                            <p class="text-muted font-13 mb-3">
                                Jika anda ingin mengubah data diri anda, silahkan isikan perubahan pada form disamping, kemudian klik tombol simpan.
                            </p>
                            <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ms-2">{{ auth()->user()->name }}</span></p>
                            
                            <p class="text-muted mb-1 font-13"><strong>Username :</strong> <span class="ms-2">{{ auth()->user()->username }}</span></p>
                            
                            <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ms-2 ">{{ auth()->user()->email }}</span></p>

                            <p class="text-muted mb-1 font-13"><strong>Posisi :</strong>
                                <span class="ms-2">
                                    @switch(auth()->user()->role)
                                        @case(1)
                                            Owner
                                        @break

                                        @case(2)
                                            Karyawan
                                        @break

                                        @case(3)
                                            Customers
                                        @break

                                        @default
                                    @endswitch
                                </span>
                            </p>
                        </div>
                    </div> <!-- end card-body -->
                </div> <!-- end card -->

            </div> <!-- end col-->

            <div class="col-xl-8 col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <form action="/ubah_profile/{{ auth()->user()->id }}" method="post">
                            @method('put')
                            @csrf
                            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Ubah Profile</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="firstname" class="form-label">Nama</label>
                                        <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="lastname" class="form-label">Username</label>
                                        <input type="text" class="form-control" name="username" value="{{ auth()->user()->username }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="useremail" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="userpassword" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Enter password">
                                    </div>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i> Simpan</button>
                            </div>
                        </form>
                    </div> <!-- end card body -->
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div>
        <!-- end row-->

    </div>
    <!-- container -->
@endsection
