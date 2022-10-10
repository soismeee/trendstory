@extends('home.layout.main')
@section('container')

    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Register</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Register Akun</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row justify-content-center">
            <div class="col-xxl-4 col-lg-5">
                <div class="card">

                    <div class="card-body p-4">
                        
                        <div class="text-center w-75 m-auto">
                            <p class="text-muted mb-4">Masukan data anda untuk membuat akun.</p>
                        </div>

                        <form action="/auth/store" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama lengkap</label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required="" value="{{ old('name') }}" placeholder="Masukan nama anda">
                                @error('name')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input class="form-control @error('username') is-invalid @enderror" type="text" name="username" required="" value="{{ old('username') }}" placeholder="Buat username anda">
                                @error('username')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" required="" value="{{ old('email') }}" placeholder="Masukan email anda">
                                @error('email')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="example-textarea" class="form-label">Alamat</label>
                                <textarea class="form-control" rows="3" name="alamat" placeholder="Masukan alamat anda">{{ old('alamat') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Buat password anda">
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 mb-0 text-center">
                                <button class="btn btn-primary" type="submit"> Register </button>
                            </div>

                        </form>
                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-muted">Sudah punya akun? <a href="/auth/login" class="text-muted ms-1"><b>Login</b></a></p>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
@endsection