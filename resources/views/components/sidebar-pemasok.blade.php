{{-- <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Navigation</div>
                    <a class="nav-link" href="/staff/dashboard">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link" href="products">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Products
                    </a>                  
                </div>
            </div>
        </nav>
    </div> --}}



    <style>
        .sb-sidenav .nav-link {
            color: white;
            padding: 8px 12px;
            border-radius: 20px;
            transition: background-color 0.3s, color 0.3s;
            margin: 6px 0;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        
        .sb-sidenav .nav-link .sb-nav-link-icon {
            font-size: 14px;
            margin-right: 5px;
            color: white; /* default icon color */
        }
        
        /* Style saat aktif */
        .sb-sidenav .nav-link.active {
            background-color: white;
            color: black !important;
        }
        
        .sb-sidenav .nav-link.active .sb-nav-link-icon {
            color: black !important; /* icon juga ikut hitam saat aktif */
        }
        
        
        </style>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Navigation</div>
                            <a class="nav-link {{ request()->is('staff/dashboard') ? 'active' : '' }}" href="/staff/dashboard">
                                <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link {{ request()->is('staff/products') ? 'active' : '' }}" href="/staff/products">
                                <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                                Data Produk
                            </a>               
                        </div>
                    </div>
                </nav>
            </div>
        
           