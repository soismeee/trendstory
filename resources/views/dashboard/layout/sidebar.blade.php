<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu leftside-menu-detached">

    <div class="leftbar-user">
        <a href="javascript: void(0);">
            <img src="/assets/images/logo_dark.png" alt="user-image" height="70">
            {{-- <span class="leftbar-user-name">Trend Story</span> --}}
        </a>
    </div>

    <!--- Sidemenu -->
    <ul class="side-nav">

        <li class="side-nav-title side-nav-item">Navigation</li>

        <li class="side-nav-item">
            <a href="/dashboard/home" class="side-nav-link">
                <i class="uil-home-alt"></i>
                <span> Dashboards </span>
            </a>
        </li>

        <li class="side-nav-title side-nav-item">Apps</li>

        <li class="side-nav-item">
            <a href="/dashboard/jenis_produk" class="side-nav-link">
                <i class="uil-calender"></i>
                <span> Jenis Produk </span>
            </a>
        </li>

        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#sidebarProjects" aria-expanded="false" aria-controls="sidebarProjects" class="side-nav-link">
                <i class="uil-briefcase"></i>
                <span> Master Produk </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarProjects">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="/dashboard/products">All Produk</a>
                    </li>
                    <li>
                        <a href="/dashboard/products/create">Belum Rilis</a>
                    </li>
                </ul>
            </div>
        </li>

        @can('admin')
            <li class="side-nav-item">
                <a href="/dashboard/metode_bayar" class="side-nav-link">
                    <i class="uil-window"></i>
                    <span> Metode Bayar </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="/dashboard/karyawans" class="side-nav-link">
                    <i class="uil-comments-alt"></i>
                    <span> Karyawan </span>
                </a>
            </li>
        @endcan

        <li class="side-nav-title side-nav-item">Administrasi</li>

        @can('karyawan')
            <li class="side-nav-item">
                <a href="/dashboard/barang_masuks" class="side-nav-link">
                    <i class="uil-layer-group"></i>
                    <span> Barang Masuk </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPembeli" aria-expanded="false" aria-controls="sidebarPembeli" class="side-nav-link">
                    <i class="uil-store"></i>
                    <span> Master Customer </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPembeli">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="/dashboard/customers">List Customers</a>
                        </li>
                        <li>
                            <a href="/dashboard/transaksi">Pesanan Customers</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endcan

        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                <i class="uil-copy-alt"></i>
                <span> Master Pelaporan </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarPages">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="/dashboard/laporan_bm">Laporan barang masuk</a>
                    </li>
                    <li>
                        <a href="/dashboard/laporan_pesanan">Laporan pesanan</a>
                    </li>
                    
                </ul>
            </div>
        </li>

        <li class="side-nav-item">
            <a href="#" class="side-nav-link" data-bs-toggle="modal" data-bs-target="#ModalLogout">
                <i class="mdi mdi-logout"></i>
                <span> Log out </span>
            </a>
        </li>
    </ul>
    <!-- End Sidebar -->

</div>
<!-- Left Sidebar End -->

<div class="modal fade" id="ModalLogout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ModalLogoutLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin keluar?
            </div>
            <form action="/auth/logout" method="post">
                @csrf
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Logout</button>
                    <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>