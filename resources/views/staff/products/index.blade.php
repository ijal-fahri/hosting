<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('asset-landing-admin/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- DataTables Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

</head>

<body class="sb-nav-fixed">
    {{-- navbar --}}
    <x-navbar-pemasok></x-navbar-pemasok>
    {{-- sidebar --}}
    <x-sidebar-pemasok></x-sidebar-pemasok>
    {{-- end --}}

    <div id="layoutSidenav_content">
        <main>
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-table me-1"></i> Data Produk</span>
                    <a href="{{ route('staff.products.create') }}" class="btn btn-primary">Tambah Produk</a>
                </div>
                <style>
                    @media (max-width: 768px) {
                        td .btn {
                            display: block;
                            width: 100%;
                            margin-bottom: 5px;
                        }
                    }

                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-top: 20px;
                        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                        border-radius: 10px;
                        overflow: hidden;
                    }

                    th,
                    td {
                        padding: 12px;
                        text-align: center;
                        border-bottom: 1px solid #ddd;
                    }

                    th {
                        background-color: #007bff;
                        color: white;
                        font-weight: bold;
                    }

                    tr:hover {
                        background-color: #f1f1f1;
                    }

                    img {
                        border-radius: 5px;
                        transition: transform 0.3s ease-in-out;
                    }

                    img:hover {
                        transform: scale(1.2);
                    }

                    table td,
                    table th {
                        color: black !important;
                    }


                    .btn {
                        padding: 5px 10px;
                        margin: 2px;
                        border: none;
                        border-radius: 5px;
                        color: white;
                        cursor: pointer;
                        transition: background 0.3s;
                    }

                    .btn-info {
                        background-color: #17a2b8;
                    }

                    .btn-info:hover {
                        background-color: #138496;
                    }

                    .btn-warning {
                        background-color: #ffc107;
                        color: black;
                    }

                    .btn-warning:hover {
                        background-color: #e0a800;
                    }

                    .btn-danger {
                        background-color: #dc3545;
                    }

                    .btn-danger:hover {
                        background-color: #c82333;
                    }
                </style>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatablesSimple" class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Deskripsi</th>
                                    <th>Kode</th>
                                    <th>Harga</th>
                                    <th>Diskon</th>
                                    <th>Harga Setelah Diskon</th>
                                    <th>Stok</th>
                                    <th>Foto</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ Str::limit($product->description, 50) }}</td>
                                        <td class="text-center">{{ $product->code }}</td>
                                        <td class="text-end">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                                        <td class="text-center">{{ $product->diskon ? $product->diskon . '%' : '-' }}
                                        </td>
                                        <td class="text-end">
                                            @if ($product->diskon)
                                                Rp{{ number_format($product->harga_diskon, 0, ',', '.') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $product->stock }}</td>
                                        <td class="text-center">
                                            @if ($product->photo)
                                                <img src="{{ asset('storage/' . $product->photo) }}"
                                                    alt="{{ $product->name }}" width="100">
                                            @else
                                                <span class="text-muted">Tidak ada foto</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span
                                                class="badge {{ $product->status == 'aktif' ? 'bg-success' : 'bg-danger' }}">
                                                {{ ucfirst($product->status) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div
                                                class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-1">
                                                <button class="btn btn-sm btn-warning edit-btn"
                                                    data-href="{{ route('staff.products.edit', $product->id) }}">Edit</button>

                                                <button class="btn btn-sm btn-info show-btn"
                                                    data-href="{{ route('staff.products.show', $product->id) }}">Show</button>
                                                <form class="d-inline delete-form"
                                                    action="{{ route('staff.products.destroy', $product->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-sm btn-danger delete-btn">Hapus</button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center">Tidak ada data produk.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
        <!-- jQuery (wajib untuk DataTables.net) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
<script src="{{ asset('asset-landing-admin/js/scripts.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="{{ asset('js/scripts.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
    crossorigin="anonymous"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#datatablesSimple').DataTable({
            responsive: true,
            autoWidth: false,
            columnDefs: [{
                    responsivePriority: 1,
                    targets: 0
                },
                {
                    responsivePriority: 2,
                    targets: -1
                }
            ]
        });

        // Edit
        $('.edit-btn').click(function() {
            const url = $(this).data('href');
            Swal.fire({
                title: 'Edit Produk?',
                text: 'Anda akan masuk ke halaman edit produk.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });

        // Show
        $('.show-btn').click(function() {
            const url = $(this).data('href');
            Swal.fire({
                title: 'Lihat Produk?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Lihat',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });

        // Delete
        $('.delete-btn').click(function() {
            const form = $(this).closest('form');
            Swal.fire({
                title: 'Hapus Produk?',
                text: 'Data akan hilang secara permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

</html>
