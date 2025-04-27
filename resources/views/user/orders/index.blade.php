<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                        Riwayat Pesanan Saya
                    </h2>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Detail
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($orders as $order)
                                                            <tr>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                    {{ $order->created_at->format('d M Y H:i') }}
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap">
                                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                                            {{ $order->status === 'Completed' ? 'bg-green-100 text-green-800' :
                                    ($order->status === 'Pending' ? 'bg-yellow-100 text-yellow-800' :
                                        'bg-blue-100 text-blue-800') }}">
                                                                        {{ $order->status }}
                                                                    </span>
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                    <button onclick="showOrderDetail({{ $order->id }})"
                                                                        class="text-indigo-600 hover:text-indigo-900">
                                                                        Lihat Detail
                                                                    </button>
                                                                </td>
                                                            </tr>

                                                            <!-- Modal Detail -->
                                                            <div id="orderDetail{{ $order->id }}"
                                                                class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
                                                                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                                                                    <div class="mt-3 text-center">
                                                                        <h3 class="text-lg leading-6 font-medium text-gray-900">Detail Pesanan</h3>
                                                                        <div class="mt-2 px-7 py-3">
                                                                            <p class="text-sm text-gray-500 text-left mb-2">
                                                                                Alamat: {{ $order->alamat }}
                                                                            </p>
                                                                            <p class="text-sm text-gray-500 text-left mb-2">
                                                                                Kurir: {{ strtoupper($order->courier) }} ({{ $order->service }})
                                                                            </p>
                                                                            <div class="mt-4 border-t pt-4">
                                                                                @foreach($order->orderItems as $item)
                                                                                    <div class="flex justify-between items-center mb-2">
                                                                                        <span class="text-sm text-gray-600">
                                                                                            {{ $item->product->name }} ({{ $item->quantity }}x)
                                                                                        </span>
                                                                                        <span class="text-sm font-medium text-gray-900">
                                                                                            Rp
                                                                                            {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                                                                        </span>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                        <div class="items-center px-4 py-3">
                                                                            <button onclick="hideOrderDetail({{ $order->id }})"
                                                                                class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
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

    <script>
        function showOrderDetail(orderId) {
            document.getElementById('orderDetail' + orderId).classList.remove('hidden');
        }

        function hideOrderDetail(orderId) {
            document.getElementById('orderDetail' + orderId).classList.add('hidden');
        }
    </script>
</x-app-layout>