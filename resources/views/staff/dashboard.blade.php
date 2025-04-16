<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.0/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('asset-landing-admin/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    {{-- navbar --}}
    <x-navbar-pemasok></x-navbar-pemasok>
    {{-- sidebar --}}
    <x-sidebar-pemasok></x-sidebar-pemasok>
    {{-- end --}}
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4 text-bold text-uppercase" style="font-size: 32px; font-weight: bold;">Welcome To Zoes
                    Store!</h1>
                <hr style="border: 2px solid black; margin-top: -5px;">
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-black text-white mb-4">
                            <div class="card-body">Jumlah Produk</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                <!-- Kartu Jumlah Stock -->
                <div class="bg-black text-white p-4 rounded-lg flex items-center justify-between">
                    <i class="fas fa-box text-3xl"></i>
                    <div>
                        <p class="text-sm">JUMLAH STOCK</p>
                        <h2 class="text-3xl font-bold">99</h2>
                    </div>
                </div>
        
                <!-- Kartu Penjualan Bulanan -->
                <div class="bg-gray-300 text-black p-4 rounded-lg flex items-center justify-between">
                    <i class="fas fa-calendar-alt text-3xl"></i>
                    <div>
                        <p class="text-sm">PENJUALAN BULANAN</p>
                        <h2 class="text-3xl font-bold">0%</h2>
                    </div>
                </div>
        
                <!-- Kartu Penjualan Pertahun -->
                <div class="bg-gray-300 text-black p-4 rounded-lg flex items-center justify-between">
                    <i class="fas fa-calendar text-3xl"></i>
                    <div>
                        <p class="text-sm">PENJUALAN PERTAHUN</p>
                        <h2 class="text-3xl font-bold">0%</h2>
                    </div>
                </div>
        
                <!-- Kartu Pesanan -->
                <div class="bg-black text-white p-4 rounded-lg flex items-center justify-between">
                    <i class="fas fa-hourglass-half text-3xl"></i>
                    <div>
                        <p class="text-sm">PESANAN</p>
                        <h2 class="text-3xl font-bold">7</h2>
                    </div>
                </div>
            </div>
        </div>
         --}}

    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('asset-landing-admin/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('asset-landing-admin/assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('asset-landing-admin/assets/demo/chart-bar-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>
