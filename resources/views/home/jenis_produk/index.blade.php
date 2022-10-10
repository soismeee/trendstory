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
            <h5 class="m-0 pb-2">
                <a class="text-dark" data-bs-toggle="collapse" href="#todayTasks" role="button" aria-expanded="false" aria-controls="todayTasks">
                    Jenis Produk
                </a>
            </h5>
            
            @foreach ($produk as $item)
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
                                <a href="apps-projects-details.html" class="text-title">{{ $item->nama }}</a>
                            </h4>

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
        
    </div>
    <!-- container -->
@endsection