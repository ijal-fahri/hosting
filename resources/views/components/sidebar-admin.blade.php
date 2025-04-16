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
                    <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="/admin/dashboard">
                        <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link {{ request()->is('admin/products') ? 'active' : '' }}" href="/admin/products">
                        <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                        Data Produk
                    </a>
                    <a class="nav-link {{ request()->is('admin/orders') ? 'active' : '' }}" href="/admin/orders">
                        <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                        Data Pesanan
                    </a>
                    <a class="nav-link {{ request()->is('admin/reports') ? 'active' : '' }}" href="/admin/reports">
                        <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                        Data Laporan
                    </a>
                    <a class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}" href="/admin/users">
                        <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                        Data Costumer
                    </a>
                    
                </div>
            </div>
        </nav>
    </div>

   