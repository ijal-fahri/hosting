<style>
    #logoutBtn:hover {
        background-color: #d3d3d3 !important; /* abu-abu muda */
        color: black !important;
    }
</style>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-black text-white">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="staff" style="font-weight: bold;">Staff Zoes</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i
            class="fas fa-bars"></i></button>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li>
                    <button type="button" id="logoutBtn" class="dropdown-item text-black">Logout</button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>

<!-- Tambahkan ini sebelum penutup </body> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('logoutBtn').addEventListener('click', function() {
        Swal.fire({
            title: 'Yakin ingin logout?',
            text: "Kamu akan keluar dari sistem.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, logout!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    });
</script>
