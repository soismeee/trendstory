<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-dark navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="/" id="topnav-dashboards" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="uil-dashboard me-1"></i>Home
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="/home/company" id="topnav-apps" role="button" aria-expanded="false">
                            <i class="uil-apps me-1"></i>Company Profile
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="uil-copy-alt me-1"></i>Katalog <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-pages">
                            <?php 

                                $jenis_produk = App\Models\JenisProduct::all();
                            ?>
                            @foreach ($jenis_produk as $jp)
                                <a href="/home/jenisproduk/{{ $jp->id }}" class="dropdown-item">{{ $jp->name }}</a>
                            @endforeach
                        </div>
                    </li>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="/home/transaksi" aria-expanded="false">
                                <i class="uil-package me-1"></i>Pesanan
                            </a>
                        </li>                    
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" data-bs-toggle="modal" data-bs-target="#modalLogout" aria-expanded="false">
                                <i class="uil-window me-1"></i>Logout
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="/auth/login" aria-expanded="false">
                                <i class="uil-window me-1"></i>Login
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>
    </div>
</div>