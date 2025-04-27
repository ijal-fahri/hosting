<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Pesanan Admin Zoes</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('asset-landing-admin/css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
</head>

<body class="sb-nav-fixed">
    <x-navbar-admin></x-navbar-admin>
    <x-sidebar-admin></x-sidebar-admin>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Data Pesanan</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Data Pesanan</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Daftar Pesanan
                    </div>

                    <div class="card-body">
                        <table id="myTable" class="display nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Pesanan</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Tanggal Pesanan</th>
                                    <th>Total Harga</th>
                                    <th>Status Pembayaran</th>
                                    <th>Status Pengiriman</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->order_number }}</td>
                                        <td>{{ $order->customer_name }}</td>
                                        <td>{{ $order->order_date }}</td>
                                        <td>Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                                        <td>
                                            <span
                                                class="badge {{ $order->payment_status == 'paid' ? 'bg-success' : 'bg-danger' }}">
                                                {{ ucfirst($order->payment_status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span
                                                class="badge {{ $order->shipping_status == 'shipped' ? 'bg-primary' : 'bg-warning' }}">
                                                {{ ucfirst($order->shipping_status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#orderDetailModal{{ $order->id }}">Lihat Detail</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada data pesanan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal for Order Details -->
    @foreach($orders as $order)
        <div class="modal fade" id="orderDetailModal{{ $order->id }}" tabindex="-1" aria-labelledby="orderDetailModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderDetailModalLabel">Detail Pesanan - {{ $order->order_number }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6>Nama Pelanggan: {{ $order->customer_name }}</h6>
                        <p><strong>Alamat Pengiriman:</strong> {{ $order->shipping_address }}</p>
                        <p><strong>Status Pembayaran:</strong> {{ ucfirst($order->payment_status) }}</p>
                        <p><strong>Status Pengiriman:</strong> {{ ucfirst($order->shipping_status) }}</p>
                        <h6>Produk yang Dipesan:</h6>
                        <ul>
                            @foreach($order->orderItems as $item)
                                <li>{{ $item->product_name }} - Rp{{ number_format($item->price, 0, ',', '.') }}
                                    ({{ $item->quantity }} pcs)</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary">Update Status</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
<script src="{{ asset('asset-landing-admin/js/scripts.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('asset-landing-admin/assets/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('asset-landing-admin/assets/demo/chart-bar-demo.js') }}"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script>
    $(document).ready(function () {
        $('#myTable').DataTable({
            responsive: true
        });
    });
</script>

</html>