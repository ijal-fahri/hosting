<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Admin Zoes Store | Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('asset-landing-admin/css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                                    <th>Nama Pelanggan</th>
                                    <th>Tanggal Pesanan</th>
                                    <th>Total Harga</th>
                                    <th>Status Pemesanan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $statusColors = [
                                        'Pending' => 'bg-secondary',
                                        'Processed' => 'bg-primary',
                                        'Delivery' => 'bg-warning',
                                        'Completed' => 'bg-success',
                                        'Cancelled' => 'bg-danger',
                                    ];
                                @endphp
                                @forelse($orders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="badge {{ $statusColors[$order->status] ?? 'bg-secondary' }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#orderDetailModal{{ $order->id }}">Lihat Detail</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data pesanan.</td>
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
    @foreach ($orders as $order)
        <div class="modal fade" id="orderDetailModal{{ $order->id }}" tabindex="-1"
            aria-labelledby="orderDetailModalLabel{{ $order->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderDetailModalLabel{{ $order->id }}">Detail Pesanan #{{ $order->id }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6>Nama Pelanggan: {{ $order->user->name }}</h6>
                        <p><strong>Alamat Penerima:</strong> {{ $order->alamat }}
                            <span class="badge {{ $statusColors[$order->status] ?? 'bg-secondary' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </p>
                        <p><strong>Bukti Pembayaran:</strong></p>
                        @if ($order->payment_photo && $order->payment_photo !== 'default.png')
                            <img src="{{ asset('storage/' . $order->payment_photo) }}" alt="Bukti Pembayaran" class="img-fluid rounded mb-3">
                        @else
                            <img src="{{ asset('storage/payment_photos/default.png') }}" alt="Bukti Pembayaran Default" class="img-fluid rounded mb-2">
                            <p class="text-muted">Belum ada bukti pembayaran yang diupload.</p>
                        @endif
                        <form id="updateStatusForm{{ $order->id }}" class="mt-3">
                            @csrf
                            <div class="mb-3">
                                <label for="status{{ $order->id }}" class="form-label">Update Status</label>
                                <select id="status{{ $order->id }}" class="form-select" name="status" {{ $order->status == 'Completed' ? 'disabled' : '' }} required>
                                    <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Processed" {{ $order->status == 'Processed' ? 'selected' : '' }}>Processed</option>
                                    <option value="Delivery" {{ $order->status == 'Delivery' ? 'selected' : '' }}>Delivery</option>
                                    <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                        </form>
                        <h6>Produk yang Dipesan:</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead><tr><th>Nama Produk</th><th>Jumlah</th></tr></thead>
                                <tbody>
                                    @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td class="d-flex align-items-center gap-2">
                                                @if ($item->product && $item->product->photo)
                                                    <img src="{{ asset('storage/' . $item->product->photo) }}" style="width:50px;height:50px;object-fit:cover;border-radius:5px;">
                                                @else
                                                    <img src="{{ asset('storage/products/default.png') }}" style="width:50px;height:50px;object-fit:cover;border-radius:5px;">
                                                @endif
                                                <span>{{ $item->product->name ?? 'Produk tidak ditemukan' }}</span>
                                            </td>
                                            <td>{{ $item->quantity }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        @if ($order->status != 'Completed')
                            <button type="button" class="btn btn-primary" onclick="updateOrderStatus({{ $order->id }})">Update Status</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('asset-landing-admin/js/scripts.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('asset-landing-admin/assets/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('asset-landing-admin/assets/demo/chart-bar-demo.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({ responsive: true });
    });

    async function updateOrderStatus(orderId) {
        try {
            const select = document.getElementById('status' + orderId);
            const status = select.value;

            const response = await fetch(`/admin/orders/${orderId}/update-status`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ status })
            });

            const result = await response.json();
            if (response.ok) {
                Swal.fire({ icon: 'success', title: 'Berhasil', text: result.message, timer: 1500, showConfirmButton: false });
                setTimeout(() => location.reload(), 1500);
            } else {
                Swal.fire({ icon: 'error', title: 'Gagal', text: result.message || 'Terjadi kesalahan' });
            }
        } catch (error) {
            Swal.fire({ icon: 'error', title: 'Error', text: error.message });
        }
    }
</script>

</html>
