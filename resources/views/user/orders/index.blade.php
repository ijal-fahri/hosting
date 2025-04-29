<x-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                        Pesanan Saya
                    </h2>

                    <!-- Tombol Riwayat -->
                    <button id="showCompletedOrdersBtn"
                        class="py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 mb-4"
                        onclick="filterOrders()">
                        Riwayat Pesanan Selesai
                    </button>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal</th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total</th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Detail</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="ordersTableBody">
                                @forelse ($orders as $order)
                                    <tr class="orderRow">
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                            {{ $order->created_at->format('d M Y H:i') }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span
                                                class="badge 
    {{ $order->status == 'Pending' ? 'bg-yellow-500 text-white' : '' }}
    {{ $order->status == 'Processed' ? 'bg-blue-500 text-white' : '' }}
    {{ $order->status == 'Delivery' ? 'bg-orange-400 text-white' : '' }}
    {{ $order->status == 'Completed' ? 'bg-green-500 text-white' : '' }}
    {{ $order->status == 'Cancelled' ? 'bg-red-500 text-white' : '' }}
    px-2 py-1 rounded-full text-xs">
                                                {{ ucfirst($order->status) }}
                                            </span>


                                        </td>
                                        <td
                                            class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 flex gap-2 items-center">
                                            <button onclick="showOrderDetail({{ $order->id }})"
                                                class="text-indigo-600 hover:text-indigo-900">
                                                Lihat Detail
                                            </button>

                                            @if ($order->status == 'Completed')
                                                <form action="{{ route('user.orders.destroy', $order->id) }}"
                                                    method="POST" onsubmit="return confirmDelete(event)">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 ml-2">
                                                        Hapus
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-gray-500 text-xs">Order belum selesai</span>
                                            @endif
                                        </td>
                                    </tr>

                                    <!-- Modal Detail -->
                                    <div id="orderDetail{{ $order->id }}"
                                        class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center p-4">
                                        <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
                                            <div class="p-6">
                                                <h3
                                                    class="text-lg leading-6 font-medium text-gray-900 mb-4 text-center">
                                                    Detail Pesanan</h3>
                                                <div class="text-left text-sm text-gray-600 space-y-2">
                                                    <p>Alamat: {{ $order->alamat }}</p>
                                                    <p>Kurir: {{ strtoupper($order->courier) }}
                                                        ({{ $order->service }})
                                                    </p>
                                                    <div class="mt-4 border-t pt-4 space-y-4">
                                                        @foreach ($order->orderItems as $item)
                                                            <div class="flex items-start gap-4">
                                                                @if ($item->product->photo)
                                                                    <img src="{{ asset('storage/' . $item->product->photo) }}"
                                                                        alt="{{ $item->product->name }}"
                                                                        class="w-16 h-16 object-cover rounded">
                                                                @else
                                                                    <div
                                                                        class="w-16 h-16 bg-gray-200 flex items-center justify-center text-xs text-gray-500 rounded">
                                                                        Tidak ada foto</div>
                                                                @endif
                                                                <div class="flex-1">
                                                                    <div
                                                                        class="flex justify-between text-sm font-medium text-gray-900">
                                                                        <span>{{ $item->product->name }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="mt-4 border-t pt-4 space-y-2">
                                                    @foreach ($order->orderItems as $item)
                                                        <div class="flex justify-between text-sm">
                                                            <span>{{ $item->product->name }}
                                                                ({{ $item->quantity }}x)
                                                            </span>
                                                            <span class="font-medium">Rp
                                                                {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="mt-6">
                                                    <button onclick="hideOrderDetail({{ $order->id }})"
                                                        class="w-full py-2 px-4 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg">
                                                        Tutup
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="4"
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                            Belum ada pesanan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showOrderDetail(orderId) {
            document.getElementById('orderDetail' + orderId).classList.remove('hidden');
        }

        function hideOrderDetail(orderId) {
            document.getElementById('orderDetail' + orderId).classList.add('hidden');
        }

        function confirmDelete(event) {
            event.preventDefault(); // stop submit dulu
            Swal.fire({
                title: 'Yakin mau hapus pesanan ini?',
                text: "Pesanan akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit(); // baru submit
                }
            });
        }

        function filterOrders() {
            const showCompleted = document.getElementById('showCompletedOrdersBtn').innerText === "Riwayat Pesanan Selesai";
            const rows = document.querySelectorAll('.orderRow');

            rows.forEach(row => {
                if (showCompleted) {
                    row.classList.toggle('hidden', row.querySelector('td:nth-child(3) span').innerText !==
                        "Completed");
                } else {
                    row.classList.toggle('hidden', row.querySelector('td:nth-child(3) span').innerText ===
                        "Completed");
                }
            });

            document.getElementById('showCompletedOrdersBtn').innerText = showCompleted ? "Tampilkan Semua Pesanan" :
                "Riwayat Pesanan Selesai";
        }
    </script>
</x-layout>