
{{-- head --}}
<x-head></x-head>
<body class="sb-nav-fixed">
    {{-- navbar --}}
    <x-navbar-admin></x-navbar-admin>
    {{-- sidebar --}}
    <x-sidebar-admin></x-sidebar-admin>
    {{-- end --}}
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4 text-bold text-uppercase" style="font-size: 32px; font-weight: bold;">Welcome To Zoes
                    Store!</h1>
                <hr style="border: 2px solid black; margin-top: -5px;">
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-gray-800 text-black mb-4">
                            <div class="card-body">Jumlah Produk</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a>{{ $jumlahProduk }} Produk</a>
                                <div class="small text-black"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-black text-white mb-4">
                            <div class="card-body">Jumlah Pesanan</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a>{{ $jumlahPesanan }} Pesanan</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card  bg-gray-800 text-black mb-4">
                            <div class="card-body">Jumlah Pengguna </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a>{{ $jumlahUserdanStaff }} Pengguna</a>
                                <div class="small text-black"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-xl-3 col-md-6">
                        <div class="card bg-black text-white mb-4">
                            <div class="card-body">Jumlah Costumer</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </main>
    </div>
    {{-- Tail --}}
    <x-tail></x-tail>
</body>

</html>
