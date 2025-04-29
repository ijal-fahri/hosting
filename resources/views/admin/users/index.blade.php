{{-- head --}}
<x-head-admin-user></x-head-admin-user>
{{-- end --}}

<body class="sb-nav-fixed">
    <x-navbar-admin></x-navbar-admin>
    <x-sidebar-admin></x-sidebar-admin>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Data User</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Data User</li>
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
                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('users.destroy', $user->id) }}"
                                                        method="POST" class="d-inline delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm delete-btn">Hapus</button>
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
</body>
{{-- tail-user --}}
<x-tail-admin-user></x-tail-admin-user>
{{-- end --}}
