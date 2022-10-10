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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Trend Story</a></li>
                            <li class="breadcrumb-item active">Jenis Produk</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Jenis Produk</h4>
                </div>
            </div>
        </div>     

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                                <!-- Product image -->
                                @if ($produk->cover == null)
                                    <div class="col-lg-5">
                                        <a href="javascript: void(0);" class="text-center d-block mb-4">
                                            <img src="/assets/images/nofoto.png" class="img-fluid" style="max-width: 280px;" alt="Product-img">
                                        </a>
    
                                        <div class="d-lg-flex d-none justify-content-center">
                                            <a href="javascript: void(0);">
                                                <img src="/assets/images/noimage.jpg" class="img-fluid img-thumbnail p-2" style="max-width: 75px;" alt="Product-img">
                                            </a>
                                            <a href="javascript: void(0);" class="ms-2">
                                                <img src="/assets/images/noimage.jpg" class="img-fluid img-thumbnail p-2" style="max-width: 75px;" alt="Product-img">
                                            </a>
                                            <a href="javascript: void(0);" class="ms-2">
                                                <img src="/assets/images/noimage.jpg" class="img-fluid img-thumbnail p-2" style="max-width: 75px;" alt="Product-img">
                                            </a>
                                        </div> 
                                    </div>
                                @else
                                    <div class="col-lg-5">
                                        <a class="text-center d-block mb-4 mt-4 preview" style="display: none"></a>
                                        <a href="javascript: void(0);" class="text-center d-block mb-4">
                                            <img src="/coverproduct/{{ $produk->cover }}" id="datagambar" class="img-fluid" style="max-width: 300px;" alt="Product-img">
                                        </a>
                                        <div class="d-lg-flex d-none justify-content-center">
                                            @foreach (App\Models\Gallery::where('product_id', $produk->id)->get() as $img)
                                                <a href="#" class="ms-2 gambarproduk" data-nama="{{ $img->name_photo }}">
                                                    <img src="/imageproduct/{{ $img->name_photo }}" class="img-fluid img-thumbnail p-2" style="max-width: 75px;" alt="Product-img">
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            <div class="col-lg-7">
                                <!-- Product title -->
                                <h3 class="mt-0">{{ $produk->nama }}</h3>
                                <p class="mb-1">Tanggal rilis: {{ date('d M Y', strtotime($produk->created_at)) }}</p>

                                <!-- Product stock -->
                                <div class="mt-3">
                                    <h4>
                                        <span class="badge badge-success-lighten">
                                            @if ($produk->status == 1)
                                            <span class="text-warning"><strong>Segera Launching</strong></span>
                                            @elseif ($produk->status == 2)
                                                <span class="text-success"><strong>Launching</strong></span>
                                            @elseif ($produk->status == 3)
                                                <span class="text-info"><strong>Terbaru</strong></span>
                                            @elseif ($produk->status == 4)
                                                <span class="text-danger"><strong>Arsip</strong></span>
                                            @endif
                                        </span>
                                    </h4>
                                </div>

                                <!-- Product description -->
                                <div class="mt-4">
                                    <h6 class="font-14">Harga barang :</h6>
                                    <h3>Rp. {{ number_format($produk->harga, 0, ',', '.') }}</h3>
                                </div>

                                <!-- Quantity -->
                                <div class="mt-4">
                                    <h6 class="font-14">Jumlah pesanan</h6>
                                    @auth
                                    <form action="/home/pesan" method="post">
                                        @if ($trans->count())
                                            <input type="hidden" name="trans_id" value="{{ $trans[0]->id }}">
                                        @else
                                            <input type="hidden" name="trans_id" value="0">
                                        @endif
                                        <input type="hidden" name="no_transaksi" value="{{ $kd->kodes }}">
                                        <div class="d-flex">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                            <input type="hidden" name="product_id" value="{{ $produk->id }}">
                                            <input type="hidden" name="harga" value="{{ $produk->harga }}">
                                            <input type="hidden" id="stok" value="{{ $produk->stok }}">
                                            <input type="number" min="1" name="jumlah" id="jumlah" value="{{ old('jumlah') }}" class="form-control @error('jumlah') is-invalid @enderror" placeholder="Qty" style="width: 90px;">
                                            <button type="submit" id="pesan" class="btn btn-success ms-2"><i class="mdi mdi-cart me-1"></i> Pesan Sekarang</button>
                                        </div>
                                    </form>
                                    @else
                                        <div class="d-flex">
                                            <input type="number" min="1" name="jumlah" value="{{ old('jumlah') }}" class="form-control" placeholder="Qty" style="width: 90px;">
                                            <button type="button" class="btn btn-danger ms-2" disabled><i class="mdi mdi-cart me-1"></i> Pesan Sekarang</button>
                                        </div>
                                    @endauth
                                    
                                </div>
                    
                                <!-- Product description -->
                                <div class="mt-4">
                                    <h6 class="font-14">Description:</h6>
                                    <p>{{ $produk->detail }} </p>
                                </div>

                                <!-- Product information -->
                                <div class="mt-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h6 class="font-14">Jenis Produk:</h6>
                                            <p class="text-sm lh-150">{{ $produk->jenisproduct->name }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="font-14">Stok Barang:</h6>
                                            <p class="text-sm lh-150">{{ $produk->stok }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row-->
                        
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->
        
    </div>
    <!-- container -->

    @section('js')
    <script>
        var jumlah = document.getElementById("jumlah");
        jumlah.addEventListener("keyup", function (e) {
            let stok = $('#stok').val();
            var a = parseInt(stok);
            var b = parseInt(jumlah.value);
            if (a < b) {
                alert("Permintaan melebihi stok barang"); 
                document.getElementById("pesan").disabled = true;
            }
            else{
                document.getElementById("pesan").disabled = false;
            }
        });
        $(document).ready(function() {
            $(document).on('click', '.gambarproduk', function(e) {
                e.preventDefault();
                let gambar = $(this).data('nama');
                $('#datagambar').hide();
                $('.preview').show();
                $('.preview').html('<img src="/imageproduct/'+gambar+'" class="img-fluid" style="max-width: 300px;" alt="Product-img">')
                console.log(gambar);
            });
        });
    </script>
    @endsection
@endsection