<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard - Daftar User</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('asset-landing-admin/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Tambahkan di <head> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .filter-btn.btn-primary {
            border: none;
        }

        .filter-btn:not(.btn-primary) {
            background-color: #e0e0e0;
            color: #333;
        }
    </style>
    <script>
        function filterRows(role) {
            document.querySelectorAll('.user-row').forEach(function(row) {
                if (role === 'all') {
                    row.style.display = '';
                } else {
                    row.style.display = row.classList.contains(role) ? '' : 'none';
                }
            });
        }

        document.querySelectorAll('.filter-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const role = this.dataset.filter;
                filterRows(role);
            });
        });

        // Tampilkan data staff saat pertama kali halaman load
        document.addEventListener('DOMContentLoaded', function() {
            filterRows('staff');
        });
    </script>

</head>

<body class="sb-nav-fixed">
    <x-navbar-admin></x-navbar-admin>
    <x-sidebar-admin></x-sidebar-admin>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Daftar User</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">User Management</li>
                </ol>

                <a href="{{ route('users.create') }}" class="btn btn-success mb-3">Tambah Staff</a>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif


                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div>
                            <i class="fas fa-table me-1"></i> Data User
                        </div>
                        <div>
                            <button class="btn btn-primary btn-sm filter-btn" data-filter="staff">Staff</button>
                            <button class="btn btn-secondary btn-sm filter-btn" data-filter="user">User</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatablesSimple" class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Tipe User</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr class="user-row {{ strtolower($user->usertype) }}">
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ ucfirst($user->usertype) }}</td>
                                            <td>
                                                @if ($user->usertype === 'staff')
                                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm delete-btn">Hapus</button>
                                                    </form>
                                                @elseif($user->usertype === 'user')
                                                    <span class="text-muted">Tidak bisa dihapus</span>
                                                @endif
                                            </td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Script -->
    <script src="{{ asset('asset-landing-admin/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('asset-landing-admin/assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('asset-landing-admin/assets/demo/chart-bar-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>

    <!-- Filter Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function filterRows(role) {
                document.querySelectorAll('.user-row').forEach(function(row) {
                    row.style.display = row.classList.contains(role) ? '' : 'none';
                });
            }

            // Show staff on page load
            filterRows('staff');

            document.querySelectorAll('.filter-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    let filter = btn.getAttribute('data-filter');
                    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove(
                        'btn-primary'));
                    btn.classList.add('btn-primary');
                    filterRows(filter);
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-btn');
    
            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const form = this.closest('form');
    
                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: "Data user akan dihapus secara permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#6c757d', // Abu-abu
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
    
</body>

</html>
