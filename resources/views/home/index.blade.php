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
                            <li class="breadcrumb-item active">Home</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Home</h4>
                </div>
            </div>
        </div>     
        
        <div class="row">
            @foreach ($products as $item)
            <div class="col-md-3 col-xxl-3">
                <a href="/home/produk/{{ $item->id }}">
                    <!-- project card -->
                    <div class="card d-block">
                        <!-- project-thumbnail -->
                        @if ($item->cover == null)
                        <img class="card-img-top" src="/assets/images/noavailable.jpg" alt="project image cap">
                        @else
                        <img class="card-img-top" src="/coverproduct/{{ $item->cover }}" alt="project image cap">
                        @endif
                        <div class="card-img-overlay">
                            <div class="badge bg-{{ $item->color }} text-light p-1">
                                @if ($item->status == 1)
                                    <span><strong>Segera Launching</strong></span>
                                    @elseif ($item->status == 2)
                                        <span><strong>Launching</strong></span>
                                    @elseif ($item->status == 3)
                                        <span><strong>Terbaru</strong></span>
                                    @elseif ($item->status == 4)
                                        <span><strong>Arsip</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="card-body position-relative">
                            <!-- project title-->
                            <h4 class="mt-0">
                                <a href="/home/produk/{{ $item->id }}" class="text-title">{{ $item->nama }}</a>
                            </h4>
                            <h5>Rp. {{ number_format($item->harga, 0, ',', '.') }}</h5>

                            <!-- project detail-->
                            <p class="mb-3">
                                <span class="pe-2 text-nowrap">
                                    <i class="mdi mdi-format-list-bulleted-type"></i>
                                    Stok <b>{{ $item->stok }}</b>
                                </span>
                            </p>
                            <div class="mb-3 text-dark" id="tooltip-container4">
                                <strong>
                                    @if (App\Models\JenisProduct::find($item->jenis_id) == null )
                                        <span class="text-danger">tidak ada</span>
                                    @else
                                        {{ $item->jenisproduct->name }}</td>
                                    @endif
                            </strong>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </a>
            </div> <!-- end col -->
            @endforeach
        </div>
        <!-- end row-->

        <div class="row">
            <h5 class="m-0 pb-2">
                <a class="text-dark" data-bs-toggle="collapse" href="#todayTasks" role="button" aria-expanded="false" aria-controls="todayTasks">
                    Product Unggulan
                </a>
            </h5>
            
            <div class="card mb-3">
                <div class="card-body">
                    @foreach ($products_unggulan as $pu)
                    <!-- task -->
                    <div class="row justify-content-sm-between">
                        <div class="col-sm-6 mb-2 mb-sm-0">
                            <div class="form-check">
                                <label class="form-check-label" for="task1">
                                    {{ $pu->nama }}
                                </label>
                            </div> <!-- end checkbox -->
                        </div> <!-- end col -->
                        <div class="col-sm-6">
                            <div class="d-flex justify-content-between">
                                <div id="tooltip-container">
                                    @if ($pu->cover == null)
                                    <img src="/assets/images/noavailable.jpg" alt="image" class="avatar-xs rounded-circle me-1">
                                    @else
                                    <img src="/coverproduct/{{ $pu->cover }}" alt="image" class="avatar-xs rounded-circle me-1">
                                    @endif
                                    &nbsp;&nbsp;&nbsp;
                                    @foreach (App\Models\Gallery::where('product_id', $pu->id)->paginate(3) as $img)
                                        <img src="/imageproduct/{{ $img->name_photo }}" class="rounded-circle avatar-xs">
                                    @endforeach
                                </div>
                                <div>
                                    <ul class="list-inline font-13 text-end">
                                        <li class="list-inline-item ms-1">
                                            <i class='uil uil-align-alt font-16 me-1'></i> {{ $pu->stok }}
                                        </li>
                                        <li class="list-inline-item ms-2">
                                            <span class="badge badge-info-lighten p-1">{{ $pu->jenisproduct->name }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div> <!-- end .d-flex-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end task -->
                    @endforeach
                </div>
            </div>

            <h5 class="m-0 pb-2">
                <a class="text-dark" data-bs-toggle="collapse" href="#todayTasks" role="button" aria-expanded="false" aria-controls="todayTasks">
                    Product Yang akan datang
                </a>
            </h5>
            
            <div class="card mb-0">
                <div class="card-body">
                    @foreach ($products_segera_launching as $psl)
                    <!-- task -->
                    <div class="row justify-content-sm-between">
                        <div class="col-sm-6 mb-2 mb-sm-0">
                            <div class="form-check">
                                <label class="form-check-label" for="task1">
                                    {{ $psl->nama }}
                                </label>
                            </div> <!-- end checkbox -->
                        </div> <!-- end col -->
                        <div class="col-sm-6">
                            <div class="d-flex justify-content-between">
                                <div id="tooltip-container">
                                    @if ($psl->cover == null)
                                    <img src="/assets/images/noavailable.jpg" alt="image" class="avatar-xs rounded-circle me-1">
                                    @else
                                    <img src="/coverproduct/{{ $psl->cover }}" alt="image" class="avatar-xs rounded-circle me-1">
                                    @endif
                                    &nbsp;&nbsp;&nbsp;
                                    @foreach (App\Models\Gallery::where('product_id', $psl->id)->paginate(3) as $img)
                                        <img src="/imageproduct/{{ $img->name_photo }}" class="rounded-circle avatar-xs">
                                    @endforeach
                                </div>
                                <div>
                                    <ul class="list-inline font-13 text-end">
                                        <li class="list-inline-item ms-1">
                                            <i class='uil uil-align-alt font-16 me-1'></i> {{ $psl->stok }}
                                        </li>
                                        <li class="list-inline-item ms-2">
                                            <span class="badge badge-info-lighten p-1">{{ $psl->jenisproduct->name }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div> <!-- end .d-flex-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end task -->
                    @endforeach
                </div>
            </div>
        </div>
        
    </div>
    <!-- container -->
@endsection