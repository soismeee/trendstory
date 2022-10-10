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
<div class="row">
    <div class="col-xxl-8 col-xl-7">
        <!-- project card -->
        <div class="card d-block">
            <div class="card-body">

                <h3 class="mt-3">{{ $produk->nama }}</h3>

                <div class="row">
                    <div class="col-6">
                        <!-- assignee -->
                        <p class="mt-2 mb-1 text-muted fw-bold font-12 text-uppercase">Stok</p>
                        <div class="d-flex">
                            <img src="/assets/images/users/avatar-9.jpg" alt="Arya S" class="rounded-circle me-2" height="24">
                            <div>
                                <h5 class="mt-1 font-14">
                                    {{ $produk->stok }}
                                </h5>
                            </div>
                        </div>
                        <!-- end assignee -->
                    </div> <!-- end col -->

                    <div class="col-6">
                        <!-- start due date -->
                        <p class="mt-2 mb-1 text-muted fw-bold font-12 text-uppercase">Jenis Produk</p>
                        <div class="d-flex">
                            <i class='uil uil-schedule font-18 text-success me-1'></i>
                            <div>
                                <h5 class="mt-1 font-14">
                                    {{ $produk->jenisproduct->name }}
                                </h5>
                            </div>
                        </div>
                        <!-- end due date -->
                    </div> <!-- end col -->
                </div> <!-- end row -->


                <h5 class="mt-2">Deskripsi:</h5>

                <p class="text-muted mb-2">
                    {{ $produk->detail }}
                </p>
                
                <form action="/dashboard/product_upload/{{ $produk->id }}" method="post" enctype="multipart/form-data">
                @csrf
                <h5 class="mt-2">Cover</h5>
                <input type="file" name="cover" id="cover" class="form-control mb-2" onchange="previewImage()">
                <h5 class="mt-2">Foto Produk (gambar bisa dipilih lebih dari satu)</h5>
                <input type="file" name="photo[]" class="form-control mb-2" multiple>
                <button type="submit" class="btn btn-success">Simpan</button>
                </form>
                
            </div> <!-- end card-body-->
            
        </div> <!-- end card-->
    </div> <!-- end col -->

    <div class="col-xxl-4 col-xl-5">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3">Preview Cover</h5>
                <img class="img-preview img-fluid col-sm-12">
            </div>
        </div>
    </div>
</div>
<!-- end row -->

@section('js')
<script>

    function previewImage(){
        const image = document.querySelector('#cover');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection

@endsection
