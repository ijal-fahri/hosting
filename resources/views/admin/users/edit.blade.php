<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard - Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('asset-landing-admin/css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <x-navbar-admin></x-navbar-admin>
    <x-sidebar-admin></x-sidebar-admin>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4 py-4">
                <h1 class="mt-4">Edit User</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User Management</a></li>
                    <li class="breadcrumb-item active">Edit User</li>
                </ol>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body">
                        <form id="updateForm" action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Password (kosongkan jika tidak ingin mengubah)</label>
                                    <input type="password" name="password" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="usertype" class="form-label">Tipe User</label>
                                    <select name="usertype" class="form-select" required>
                                        <option value="staff" {{ $user->usertype == 'staff' ? 'selected' : '' }}>Staff</option>
                                        <option value="admin" {{ $user->usertype == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="user" {{ $user->usertype == 'user' ? 'selected' : '' }}>User</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between flex-wrap gap-2">
                                <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" id="submitBtn" class="btn btn-primary">Perbarui</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Script -->
    <script src="{{ asset('asset-landing-admin/js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- SweetAlert untuk Konfirmasi Submit -->
    <script>
        document.getElementById('submitBtn').addEventListener('click', function (e) {
            e.preventDefault(); // Cegah submit langsung

            Swal.fire({
                title: 'Yakin ingin memperbarui data?',
                text: "Data user akan diubah.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, perbarui!',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#6c757d', // Abu-abu
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('updateForm').submit();
                }
            });
        });
    </script>
</body>

</html>
