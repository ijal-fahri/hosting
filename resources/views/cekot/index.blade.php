<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Konfirmasi Pesanan - Pixel Notes Shop</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                fontFamily: {
                    sans: ['Inter', 'ui-sans-serif', 'system-ui'],
                },
                extend: {
                    colors: {
                        brand: {
                            DEFAULT: '#FA734C',
                            light: '#FFF3EF',
                            dark: '#E05A3C'
                        }
                    },
                    animation: {
                        'pulse-slow': 'pulse 2s ease-in-out infinite'
                    }
                }
            }
        }
    </script>
    <meta name="theme-color" content="#FA734C" />
</head>

<body class="bg-gray-50 text-gray-800 font-sans leading-relaxed">
    <!-- Header -->
    <header class="sticky top-0 bg-white border-b shadow z-50">
        <div class="max-w-7xl mx-auto flex items-center px-6 py-4">
            <button onclick="history.back()" aria-label="Kembali"
                class="p-2 hover:bg-gray-100 rounded-lg transition-transform hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <h1 class="ml-4 text-2xl font-semibold text-gray-700">Konfirmasi Pesanan</h1>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <section class="lg:col-span-2 space-y-10">
            <!-- Progress Steps -->
            <nav class="flex items-center justify-center space-x-6 text-sm">
                <div class="flex items-center space-x-2 text-gray-400">
                    <div
                        class="w-6 h-6 flex items-center justify-center rounded-full bg-brand-light text-brand font-medium">
                        1</div>
                    <span>Keranjang</span>
                </div>
                <span class="text-gray-300">→</span>
                <div class="flex items-center space-x-2 text-white">
                    <div class="w-6 h-6 flex items-center justify-center rounded-full bg-brand shadow-md">2</div>
                    <span class="font-medium text-gray-800">Konfirmasi</span>
                </div>
                <span class="text-gray-300">→</span>
                <div class="flex items-center space-x-2 text-gray-300">
                    <div class="w-6 h-6 flex items-center justify-center rounded-full border border-gray-200">3</div>
                    <span>Selesai</span>
                </div>
            </nav>

            <!-- Product List -->
            <div class="bg-white rounded-2xl shadow-lg p-6 space-y-6">
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-3">Daftar Produk</h2>
                <div class="divide-y divide-gray-200">
                    @foreach ($items as $item)
                        <article
                            class="flex flex-col sm:flex-row items-center py-6 hover:shadow-xl transition-transform transform hover:scale-105 rounded-lg bg-gray-50">
                            <img src="{{ asset('storage/' . $item->product->photo) }}" alt="Produk Contoh"
                                class="w-32 h-32 sm:w-36 sm:h-36 rounded-lg object-cover object-center" />
                            <div class="flex-1 px-6 mt-4 sm:mt-0">
                                <h3 class="text-lg font-semibold text-gray-700 hover:text-brand transition">
                                    {{ $item->product->name }}
                                </h3>
                                {{-- <p class="text-sm text-gray-500 mt-1">Merah • M • 6–12 bulan</p> --}}
                                {{-- <div class="mt-4 inline-flex items-center bg-gray-100 rounded-full overflow-hidden">
                                    <button class="px-3 py-1 hover:bg-gray-200 transition"><svg
                                            xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" />
                                        </svg></button>
                                    <span class="px-4 py-1 font-medium text-gray-700">1</span>
                                    <button class="px-3 py-1 hover:bg-gray-200 transition"><svg
                                            xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" />
                                        </svg></button>
                                </div> --}}
                            </div>
                            <div class="text-right mt-4 sm:mt-0">
                                <p class="text-xl font-bold text-gray-900">Rp
                                    {{ number_format($item->product->price * $item->quantity, 2) }}
                                </p>
                            </div>
                        </article>
                    @endforeach
                    <!-- Produk lain -->
                </div>
            </div>

            <!-- Shipping Address -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-3">Alamat Pengiriman</h2>
                <div class="mt-6 space-y-4">
                    <h2 class="text-lg font-medium text-gray-700">Cek Ongkir</h2>
                    <h3 class="text-lg font-medium text-gray-700">Kota Asal</h3>

                    <!-- Form Cek Ongkir -->
                    <form id="checkCostForm" class="space-y-4">
                        @csrf
                        <input type="hidden" name="selected_items" value="{{ json_encode($items->pluck('id')) }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kota Asal</label>
                                <select name="origin" id="origin" class="mt-1 block w-full rounded-md border-gray-300"
                                    required>
                                    <option value="">Pilih Kota Asal</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city['city_id'] }}">{{ $city['city_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kota Tujuan</label>
                                <select name="destination" id="destination"
                                    class="mt-1 block w-full rounded-md border-gray-300" required>
                                    <option value="">Pilih Kota Tujuan</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city['city_id'] }}">{{ $city['city_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kurir</label>
                                <select name="courier" id="courier" class="mt-1 block w-full rounded-md border-gray-300"
                                    required>
                                    <option value="">Pilih Kurir</option>
                                    <option value="jne">JNE</option>
                                    <option value="pos">POS</option>
                                    <option value="tiki">TIKI</option>
                                </select>
                            </div>

                            <input type="hidden" name="weight" value="1000">
                        </div>

                        <button type="button" onclick="checkShippingCost()"
                            class="w-full bg-brand text-white py-2 rounded-lg">
                            Cek Ongkir
                        </button>
                    </form>

                    <div id="shippingOptions" class="mt-4 hidden">
                        <!-- Shipping options will be populated here -->
                    </div>

                    <!-- Form Simpan Pesanan -->
                    @if (!empty($costs))
                        <form action="{{ route('cekot.store') }}" method="POST" enctype="multipart/form-data"
                            class="space-y-4 bg-white p-6 rounded-2xl shadow">
                            @csrf

                            <!-- Pilih Layanan -->
                            <div>
                                <label for="service" class="block text-sm font-semibold text-gray-700">Pilih
                                    Layanan</label>
                                <select id="service" name="service"
                                    class="mt-2 border border-gray-300 rounded-md p-3 w-full bg-white text-gray-700"
                                    onchange="updateTotal()" required>
                                    <option value="" data-cost="0">-- Pilih Layanan --</option>
                                    @foreach ($costs[0]['costs'] as $item)
                                        <option value="{{ $item['service'] }}" data-cost="{{ $item['cost'][0]['value'] }}">
                                            {{ $item['service'] }} - Rp
                                            {{ number_format($item['cost'][0]['value'], 0, ',', '.') }}
                                            (ETD: {{ $item['cost'][0]['etd'] }} hari)
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <!-- Masukan -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Masukan (opsional)</label>
                                <textarea name="masukan" class="mt-1 block w-full border rounded-md p-2"></textarea>
                            </div>

                            <!-- Alamat -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Alamat Pengiriman</label>
                                <textarea name="alamat" class="mt-1 block w-full border rounded-md p-2" required></textarea>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                class="bg-brand text-white px-4 py-2 rounded-xl hover:shadow-lg transition">
                                Simpan Pesanan
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <script>
                async function checkShippingCost() {
                    const form = document.getElementById('checkCostForm');
                    const formData = new FormData(form);

                    try {
                        const response = await fetch('{{ route("checkCost") }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: formData
                        });

                        const result = await response.json();

                        if (result.status === 'success') {
                            const shippingOptions = document.getElementById('shippingOptions');
                            shippingOptions.innerHTML = `
                                <div class="mt-4">
                                    <label class="block text-sm font-medium text-gray-700">Pilih Layanan</label>
                                    <select id="service" name="service" class="mt-1 block w-full rounded-md border-gray-300" onchange="updateTotal()">
                                        <option value="">Pilih Layanan</option>
                                        ${result.data.map(service => `
                                            <option value="${service.service}" data-cost="${service.cost[0].value}">
                                                ${service.service} - Rp ${new Intl.NumberFormat('id-ID').format(service.cost[0].value)}
                                                (${service.cost[0].etd} hari)
                                            </option>
                                        `).join('')}
                                    </select>
                                </div>
                            `;
                            shippingOptions.classList.remove('hidden');
                        } else {
                            alert(result.message);
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat mengecek ongkir');
                    }
                }

                function updateTotal() {
                    const subtotal = {{ $subtotal ?? 0 }}; // Add null coalescing operator
                    const serviceSelect = document.getElementById('service');
                    const shippingCost = parseInt(serviceSelect.options[serviceSelect.selectedIndex].dataset.cost || 0);
                    const total = subtotal + shippingCost;

                    // Update tampilan desktop
                    document.getElementById('shippingCost').innerText = formatRupiah(shippingCost);
                    document.getElementById('totalPrice').innerText = formatRupiah(total);

                    // Update tampilan mobile if exists
                    const mobileTotal = document.getElementById('mobileTotal');
                    if (mobileTotal) {
                        mobileTotal.innerText = formatRupiah(total);
                    }
                }

                function formatRupiah(number) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(number);
                }
            </script>

            <div id="total-akhir" class="mt-4 text-lg font-bold text-gray-800"></div>
            </div>
        </section>

        <!-- Sidebar Summary & Methods -->
        <aside class="space-y-6">
            <!-- Price Summary -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Ringkasan Harga</h2>
                <dl class="space-y-2 text-sm text-gray-600">
                    <div class="flex justify-between">
                        <dt>Subtotal</dt>
                        <dd id="subtotal">Rp {{ number_format($subtotal ?? 0, 0, ',', '.') }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt>Ongkir</dt>
                        <dd id="shippingCost">Rp 0</dd>
                    </div>
                </dl>
                <div class="border-t mt-4 pt-4 flex justify-between items-center">
                    <span class="font-medium text-gray-800">Total</span>
                    <span class="text-2xl font-bold text-gray-900" id="totalPrice">
                        Rp {{ number_format($subtotal ?? 0, 0, ',', '.') }}
                    </span>
                </div>
            </div>

            <!-- Payment Method and Pay Button -->
            <form id="orderForm" action="{{ route('cekot.store') }}" method="POST">
                @csrf
                <input type="hidden" name="shipping_cost" id="shippingCostInput">
                <input type="hidden" name="total_price" id="totalPriceInput">
                <input type="hidden" name="service" id="selectedServiceInput">

                <!-- Payment Method -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Metode Pembayaran</h2>
                    <ul class="space-y-4">
                        <li>
                            <label
                                class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-brand transition focus-within:ring-2 focus-within:ring-brand">
                                <input type="radio" name="payment_method" value="cod" class="form-radio text-brand"
                                    required />
                                <span class="ml-3 text-gray-700">COD</span>
                            </label>
                        </li>
                        <li>
                            <label
                                class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-brand transition focus-within:ring-2 focus-within:ring-brand">
                                <input type="radio" name="payment_method" value="midtrans" class="form-radio text-brand"
                                    required />
                                <span class="ml-3 text-gray-700">Midtrans</span>
                            </label>
                        </li>
                    </ul>
                </div>

                <!-- Pay Button -->
                <button type="submit"
                    class="w-full bg-brand text-white py-3 rounded-2xl font-semibold uppercase shadow-md hover:shadow-lg active:scale-95 transform transition">
                    Pesan Sekarang
                </button>
            </form>
        </aside>
    </main>

    <!-- Mobile Footer Bar -->
    {{-- <div class="lg:hidden fixed bottom-0 left-0 w-full bg-white shadow-inner border-t z-50">
        <div class="flex items-center justify-between max-w-7xl mx-auto px-6 py-4">
            <div>
                <p class="text-sm text-gray-600">Total</p>
                <p class="text-lg font-bold text-gray-900" id="mobileTotal">
                    Rp {{ number_format($subtotal, 0, ',', '.') }}
                </p>
            </div>
            <button
                class="bg-brand text-white px-6 py-2 rounded-2xl font-semibold uppercase shadow-md hover:shadow-lg active:scale-95 transition">
                Bayar
            </button>
        </div>
    </div> --}}
</body>
<script>
    document.getElementById('provinsi').addEventListener('change', function () {
        let provinceId = this.value;
        fetch(`/get-cities/${provinceId}`)
            .then(res => res.json())
            .then(data => {
                let kotaSelect = document.getElementById('kota');
                kotaSelect.innerHTML = '<option value="">-- Pilih Kota --</option>';
                data.forEach(k => {
                    kotaSelect.innerHTML += `<option value="${k.city_id}">${k.city_name}</option>`;
                });
            });
    });
</script>

</html>