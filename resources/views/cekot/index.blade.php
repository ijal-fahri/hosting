<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chekout</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                            </div>
                            <div class="text-right mt-4 sm:mt-0">
                                <p class="text-xl font-bold text-gray-900">Rp
                                    {{ number_format($item->product->harga_diskon * $item->quantity, 2) }}
                                </p>
                            </div>
                        </article>
                    @endforeach
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
                                <select name="origin" id="origin"
                                    class="mt-1 block w-full rounded-md border-gray-300" required>
                                    <option value="">Pilih Kota Asal</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city['city_id'] }}">{{ $city['city_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kota Tujuan</label>
                                <select name="destination" id="destination"
                                    class="mt-1 block w-full rounded-md border-gray-300" required>
                                    <option value="">Pilih Kota Tujuan</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city['city_id'] }}">{{ $city['city_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kurir</label>
                                <select name="courier" id="courier"
                                    class="mt-1 block w-full rounded-md border-gray-300" required>
                                    <option value="">Pilih Kurir</option>
                                    <option value="jne">JNE</option>
                                    <option value="pos">POS</option>
                                    <option value="tiki">TIKI</option>
                                </select>
                            </div>

                            <input type="hidden" name="weight" value="1000">
                        </div>

                        <button type="button" onclick="checkShippingCost()"
                            class="w-full bg-black text-white py-2 rounded-lg">
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
                                        <option value="{{ $item['service'] }}"
                                            data-cost="{{ $item['cost'][0]['value'] }}">
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
                            <button type="submit" class="w-full bg-black text-white py-3 rounded-2xl font-semibold">
                                Pesan Sekarang
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <script>
                async function checkShippingCost() {
                    const form = document.getElementById('checkCostForm');
                    const formData = new FormData(form);

                    // Store selected values in hidden inputs
                    document.getElementById('destinationInput').value = document.getElementById('destination').value;
                    document.getElementById('courierInput').value = document.getElementById('courier').value;

                    try {
                        const response = await fetch('{{ route('checkCost') }}', {
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

                            // Show the order form after shipping options are loaded
                            document.getElementById('orderForm').classList.remove('hidden');
                        } else {
                            alert(result.message);
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat mengecek ongkir');
                    }
                }

                function updateTotal() {
                    const subtotal = {{ $subtotal ?? 0 }};
                    const serviceSelect = document.getElementById('service');
                    const shippingCost = parseInt(serviceSelect.options[serviceSelect.selectedIndex].dataset.cost || 0);
                    const total = subtotal + shippingCost;

                    // Update hidden inputs
                    document.getElementById('serviceInput').value = serviceSelect.value;
                    document.getElementById('shippingCostInput').value = total;

                    // Update price display
                    document.getElementById('shippingCost').innerText = formatRupiah(shippingCost);
                    document.getElementById('totalPrice').innerText = formatRupiah(total);
                }

                function formatRupiah(number) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(number);
                }

                document.getElementById('orderForm').addEventListener('submit', async function(e) {
                    e.preventDefault();

                    // Check if shipping service is selected
                    const serviceSelect = document.getElementById('service');
                    if (!serviceSelect || !serviceSelect.value) {
                        alert('Silakan pilih layanan pengiriman terlebih dahulu');
                        return;
                    }

                    // Calculate total price (subtotal + shipping cost)
                    const subtotal = {{ $subtotal ?? 0 }};
                    const shippingCost = parseInt(serviceSelect.options[serviceSelect.selectedIndex].dataset.cost || 0);
                    const totalPrice = subtotal + shippingCost;

                    // Update hidden inputs
                    document.getElementById('shippingCostInput').value = totalPrice;
                    document.getElementById('serviceInput').value = serviceSelect.value;

                    try {
                        const formData = new FormData(this);
                        const response = await fetch(this.action, {
                            method: 'POST',
                            body: formData
                        });

                        const result = await response.json();

                        if (response.ok) {
                            alert(result.message);
                            if (result.redirect) {
                                window.location.href = result.redirect;
                            }
                        } else {
                            throw new Error(result.message || 'Terjadi kesalahan');
                        }
                    } catch (error) {
                        alert(error.message);
                    }
                });

                function toggleQRCode() {
                    const paymentMethod = document.getElementById('paymentMethod').value;
                    const qrCodeContainer = document.getElementById('qrCodeContainer');
                    if (paymentMethod === 'cod') {
                        qrCodeContainer.classList.remove('hidden');
                    } else {
                        qrCodeContainer.classList.add('hidden');
                    }
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
            <form id="orderForm" action="{{ route('cekot.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="selected_items" value="{{ json_encode($items->pluck('id')) }}">
                <input type="hidden" name="shipping_cost" id="shippingCostInput">
                <input type="hidden" name="courier" id="courierInput">
                <input type="hidden" name="service" id="serviceInput">
                <input type="hidden" name="destination" id="destinationInput">

                <!-- Alamat Pengiriman -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                    <textarea name="alamat" class="mt-1 block w-full rounded-md border-gray-300" required></textarea>
                </div>

                <!-- Catatan -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Catatan (Opsional)</label>
                    <textarea name="masukan" class="mt-1 block w-full rounded-md border-gray-300"></textarea>
                </div>

                <!-- Payment Method -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                    <select name="payment_method" id="paymentMethod"
                        class="mt-1 block w-full rounded-md border-gray-300" required onchange="toggleQRCode()">
                        <option value="">Pilih Metode Pembayaran</option>
                        <option value="cod">Qris</option>
                    </select>

                    <!-- QR Code Container -->
                    <div id="qrCodeContainer" class="hidden mt-4">
                        <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <p class="text-sm text-gray-600 mb-2">Scan QR Code untuk pembayaran:</p>
                            <img src="{{ asset('asset-landing-admin/qris/qris.jpg') }}" alt="QR Code"
                                class="mx-auto w-48 h-48">
                            <p class="text-xs text-gray-500 mt-2 text-center">Silakan scan QR Code ini untuk melakukan
                                pembayaran QRIS</p>
                            <div class="mb-3">
                                <label for="payment_photo" class="form-label">Upload Bukti Pembayaran</label>
                                <input type="file" class="form-control" name="payment_photo" id="payment_photo"
                                    {{ old('payment_method') == 'cod' ? 'required' : '' }}>
                            </div>

                        </div>
                    </div>
                </div>
                <button type="submit" class="w-full bg-black  text-white py-3 rounded-2xl font-semibold transition">
                    Bayar Sekarang
                </button>
            </form>
        </aside>
    </main>

    <script>
        document.getElementById('provinsi').addEventListener('change', function() {
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

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('checkoutForm'); // ganti id ini sesuai form kamu

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                fetch(this.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: data.message,
                                confirmButtonText: 'Oke'
                            }).then(() => {
                                window.location.href = data
                                    .redirect; // Redirect ke halaman order.index
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: data.message,
                                confirmButtonText: 'Coba Lagi'
                            });
                        }
                    })
                    .catch(error => {
                        console.error(error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat mengirim data.',
                            confirmButtonText: 'Coba Lagi'
                        });
                    });
            });
        });
    </script>

</html>
