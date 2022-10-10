@extends('dashboard.layout.main')
@section('container')
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
                    <h4 class="page-title">Laporan Pesanan</h4>
                </div>
            </div>
        </div>
        
        <div class="row">
            <form action="/dashboard/cetak_pesanan" method="post">
                @csrf
                <div class="row gy-2 gx-2 align-items-center">
                    <h6 class="font-13 mt-3">Inputkan tanggal awal - tanggal akhir</h6>
                    <div class="col-4">
                        <input type="date" name="awal" class="form-control mb-2 awal" id="inlineFormInput">
                    </div>
                    <div class="col-4">
                        <div class="input-group mb-2">
                            <input type="date" name="akhir" class="form-control akhir" id="inlineFormInputGroup">
                        </div>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-dark mb-2" id="lihatbm">Lihat</button>
                        <button type="submit" class="btn btn-info mb-2">Cetak</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <table class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th width="35%">No Pesanan</th>
                                    <th width="20%">Nama</th>
                                    <th width="25%">Produk</th>
                                    <th width="10%">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- container -->

@section('js')
    <script>
        $(document).ready(function() {

            $(document).on('click', '#lihatbm', function(e) {
                e.preventDefault();
                var awal = $('.awal').val();
                var akhir = $('.akhir').val();

                var data = {
                    'awal': awal,
                    'akhir': akhir,
                    '_token': '{{ csrf_token() }}'
                }
                // console.log(data);

                $.ajax({
                    type: "POST",
                    url: "/dashboard/lihat_pesanan",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if (response.status == 404) {
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-danger');
                            $('#success_message').text(response.message);
                        } else {
                            console.log(response);
                            $.each(response.transaksi, function(key, item) {
                                $('tbody').append(
                                    '<tr>\
                                            <td>' + item.no_transaksi + '</td>\
                                            <td>' + item.user_id + '</td>\
                                            <td>' + item.product_id + '</td>\
                                            <td>' + item.jumlah + '</td>\
                                        </tr>'
                                );
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection

@endsection
