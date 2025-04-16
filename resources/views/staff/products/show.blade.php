<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Detail Produk - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('asset-landing-admin/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <x-navbar-pemasok></x-navbar-pemasok>
    <x-sidebar-pemasok></x-sidebar-pemasok>
    
    <div id="layoutSidenav_content">
        <main>
            <div class="container mt-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Detail Produk</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Nama Produk</th>
                                <td>{{ $product->name }}</td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td>{{ $product->description }}</td>
                            </tr>
                            <tr>
                                <th>Kode</th>
                                <td>{{ $product->code }}</td>
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Diskon</th>
                                <td>{{ $product->diskon ? $product->diskon . '%' : '-' }}</td>
                            </tr>
                            <tr>
                                <th>Harga Setelah Diskon</th>
                                <td>
                                    @if ($product->diskon)
                                        Rp{{ number_format($product->harga_diskon, 0, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Stok</th>
                                <td>{{ $product->stock }}</td>
                            </tr>
                            <tr>
                                <th>Foto</th>
                                <td>
                                    @if ($product->photo)
                                        <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}" width="200">
                                    @else
                                        <span class="text-muted">Tidak ada foto</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <span class="badge {{ $product->status == 'aktif' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($product->status) }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                        <a href="{{ route('staff.products.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
<script src="{{ asset('asset-landing-admin/js/scripts.js') }}"></script>
</html>