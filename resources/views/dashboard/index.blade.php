@extends('dashboard.layout.main')
@section('container')

    <div class="content">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Halaman</a></li>
                            <li class="breadcrumb-item active">Utama</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Halaman utama</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-xl-5 col-lg-6">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-account-multiple widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Pesanan</h5>
                                <h3 class="mt-3 mb-3">{{ $pesanan->count() }}</h3>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-lg-6">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-cart-plus widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Pelanggan</h5>
                                <h3 class="mt-3 mb-3">{{ $pelanggan->count() }}</h3>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div> <!-- end row -->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-currency-usd widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Average Revenue">Jenis Produk</h5>
                                <h3 class="mt-3 mb-3">{{ $jenis_produk->count() }}</h3>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-lg-6">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-pulse widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Growth">Produk</h5>
                                <h3 class="mt-3 mb-3">{{ $produk->count() }}</h3>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div> <!-- end row -->

            </div> <!-- end col -->

            <div class="col-xl-7 col-lg-6">
                <div class="col-lg-12">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-pulse widget-icon"></i>
                            </div>
                            <h4 class="text-muted fw-normal mt-0" title="Growth">Pendapatan hari ini</h4>
                            @foreach ($hari_ini as $item)
                            <?php $hari += $item->nominal_bayar ?>
                            @endforeach
                            <h3 class="mt-3 mb-3">Rp. {{ number_format($hari, 0, ',', '.') }}</h3>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col-lg-12">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-pulse widget-icon"></i>
                            </div>
                            <h4 class="text-muted fw-normal mt-0" title="Growth">Pendapatan bulan ini</h4>
                            @foreach ($bulan_ini as $item)
                            <?php $bulan += $item->nominal_bayar ?>
                            @endforeach
                            <h3 class="mt-3 mb-3">Rp. {{ number_format($bulan, 0, ',', '.') }}</h3>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->

        
    </div>
    <!-- End Content -->

@endsection
