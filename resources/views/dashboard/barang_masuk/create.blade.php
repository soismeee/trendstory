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
                    <h4 class="page-title">Form Input Barang Masuk</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if (session()->has('error'))
                        <div class="alert alert-danger col-lg-12" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <form action="/dashboard/barang_masuks" method="post" class="form-produk">
                                    @csrf
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-centered mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 10%"><a type="button" class="action-icon btn-remove"><i class="mdi mdi-delete"></i></a></th>
                                                    <th style="width: 60%">Nama Produk</th>
                                                    <th style="width: 30%">Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                            <tfoot style="display:none">
                                                <tr class="bg-light">
                                                    <th colspan="2">Total Barang</th>
                                                    <th class="grand-total"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div> <!-- end table-responsive-->
                                    <hr>
                                    @if ($no_bm->count())
                                        <input type="hidden" name="trans_id" value="{{ $no_bm[0]->id }}">
                                    @else
                                        <input type="hidden" name="trans_id" value="0">
                                    @endif
                                    <input type="hidden" name="no_trans" value="{{ $kd->kodes }}">
                                    {{-- <input type="text" id="produkid" name="produkid" class="form-control produkid"> --}}
                                    
                                    <div class="row mt-4">
                                        <div class="col-sm-12">
                                            <div class="text-sm-end">
                                                <button href="apps-ecommerce-checkout.html" class="btn btn-danger">
                                                    <i class="mdi mdi-cart-plus me-1"></i> Simpan Barang Masuk </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- end col -->

                            <div class="col-lg-4">
                                <div class="border p-3 mt-4 mt-lg-0 rounded">
                                    <h4 class="header-title mb-3">Pilih Produk</h4>
                                    <select class="form-control select2 @error('produk_id') is-invalid @enderror"
                                        data-toggle="select2" name="produk_id" id="produk_id">
                                        <option value="">Pilih data produk</option>
                                        @foreach ($products as $item)
                                            <option {{ $item->id == old('produk_id') ? 'selected' : '' }}
                                                value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                    <div class="row mt-2">
                                        <div class="col-sm-12">
                                            <div class="text-sm-end">
                                                <button class="btn btn-primary" id="add-produk">+ Tambah produk</button>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row-->
                                </div> <!-- end .border-->
                            </div>

                        </div> <!-- end col -->

                    </div> <!-- end row -->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div> <!-- container -->

    <div id="dataproductnotselect" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="dripicons-warning h1 text-warning"></i>
                        <h4 class="mt-2">Peringatan!!!</h4>
                        <p class="mt-3 isipesan">Maaf, anda belum memilih obat apapun!!</p>
                        <button type="button" class="btn btn-warning my-2" data-bs-dismiss="modal">Mengerti</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('js')
    <script>
        $(document).ready(function() {

            let arrayProduk = [];
            $(document).on('click', '#add-produk', function(e) {
                e.preventDefault();
                let id = $('#produk_id').val();
                if (!id) return $('#dataproductnotselect').modal('show');
                if (arrayProduk.filter(item => item.id == id).length > 0) return $('#dataproductnotselect')
                    .modal('show');
                $('.isipesan').text("Data obat sudah dipilih, silahkan pilih obat lain!!");
                // console.log(produk_id)

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "GET",
                    url: "/dashboard/barang_masuks/" + id,
                    success: function(response) {
                        // console.log(response);
                        if (response.status == 404) {
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-danger');
                            $('#success_message').text(response.message);
                        } else {
                            console.log(response);
                            // $('tbody').append(
                            let html =
                                '<tr id="'+response.produks.id+'">\
                                    <td><a data-id="'+response.produks.id+'" type="button" class="action-icon remove-item"> <i class="mdi mdi-delete"></i></a></td>\
                                    <td>'+response.produks.nama+'<input type="hidden" name="product[]" value="'+response.produks.id+'"></td>\
                                    <td><input type="number" name="jumlah[]" data-id="'+response.produks.id+'" id="jumlah" class="form-control jumlah" value="1" min="1"></td>\
                                            </tr>';
                            // );
                            arrayProduk.push({
                                id: response.produks.id,
                                jumlah: 1,
                                total: 1
                            });
                            let grand_total = 0;
                            arrayProduk.forEach(val => grand_total = grand_total + parseInt(val.total));
                            $('.form-produk table tbody').append(html);
                            $('tfoot').show();
                            $('.grand-total').html('<h4>'+grand_total+'</h4> <input type="hidden" name="grand_total" value="'+grand_total+'">');
                        }
                    }
                });
            });

            $(document).on('change', '.jumlah', function() {
                let id = $(this).data('id');
                let jumlah = $(this).val();
                let total = jumlah;
                console.log(total);
                objIndex = arrayProduk.findIndex((obj => obj.id == id));
                arrayProduk[objIndex].jumlah = jumlah;
                arrayProduk[objIndex].total = total;
                countGrandTotal();
            });

            $('.form-produk table').on('click', '.btn-remove', function() {
                if (arrayProduk.length == 0) return $('#dataproductnotselect').modal('show');
                arrayProduk = [];
                $('.form-produk table tbody').html('');
                $('.form-produk #data_obat').html('');
                $('.grand-total').html('');
                $('.form-produk table tfoot').hide();
                countGrandTotal();
            });

            $('.form-produk table').on('click', '.remove-item', function() {
                if (arrayProduk.length == 0) return alert('Belum ada item obat dipilih!');
                $(this).parent().parent().remove();
                let id = $(this).data('id');
                arrayProduk = arrayProduk.filter(e => e.id != id);
                $('.form-produk #data_obat').val(JSON.stringify(arrayProduk));
                countGrandTotal();
            });

            function countGrandTotal() {
                let grand_total = 0;
                arrayProduk.forEach(val => grand_total = grand_total + parseInt(val.total));
                if (grand_total <= 0) {
                    $('.form-produk table tfoot').hide();
                }
                $('.grand-total').html('<h4>'+grand_total+'</h4><input type="hidden" name="grand_total" value="'+grand_total+'">')
            }
        });
    </script>
@endsection
