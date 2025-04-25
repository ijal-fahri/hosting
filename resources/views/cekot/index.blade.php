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
                                    {{ $item->product->name }}</h3>
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
                                    {{ number_format($item->product->price * $item->quantity, 2) }}</p>
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
                    <form action="{{ route('checkCost') }}" method="POST">
                        @csrf
                        <input type="hidden" name="selected_items" value="{{ json_encode($items->pluck('id')) }}">

                        <!-- Kota Asal -->
                        <select name="origin" id="origin" class="w-full p-3 border border-gray-300 rounded-lg mb-4">
                            @if (!empty($bogorCity))
                                <option value="{{ $bogorCity['city_id'] }}" selected>
                                    {{ $bogorCity['city_name'] }}
                                </option>
                            @else
                                <option value="">Data Kota Tidak Tersedia</option>
                            @endif
                        </select>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Provinsi -->
                            <select id="province" name="province" class="w-full p-3 border border-gray-300 rounded-lg">
                                <option value="">Pilih Provinsi</option>
                                @if (!empty($provinces))
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province['province_id'] }}">{{ $province['province'] }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>

                            <!-- Kota Tujuan -->
                            <select id="destination" name="destination"
                                class="w-full p-3 border border-gray-300 rounded-lg">
                                <option value="">-- Pilih Kota Tujuan --</option>
                            </select>

                            <!-- Berat -->
                            <input type="number" id="weight" name="weight" placeholder="Berat (gram)"
                                class="w-full p-3 border border-gray-300 rounded-lg" />

                            <!-- Kurir -->
                            <select id="courier" name="courier" class="w-full p-3 border border-gray-300 rounded-lg">
                                <option value="">Pilih Kurir</option>
                                <option value="jne">JNE</option>
                                <option value="pos">POS</option>
                                <option value="tiki">TIKI</option>
                            </select>
                        </div>

                        <button type="submit"
                            class="mt-4 px-4 py-2 bg-orange-500 rounded-lg text-white font-semibold">Cek Ongkir</button>
                    </form>

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
                            <button type="submit"
                                class="bg-brand text-white px-4 py-2 rounded-xl hover:shadow-lg transition">
                                Simpan Pesanan
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <script>
                function updateTotal() {
                    const serviceSelect = document.getElementById('service');
                    const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
                    const cost = parseInt(selectedOption.getAttribute('data-cost')) || 0;
                    const productTotal = {{ $items->sum(fn($item) => $item->product->price * $item->quantity) }};
                    const total = productTotal + cost;

                    document.getElementById('total_price').value = total;
                }
            </script>



            {{-- <div class="mt-4 text-gray-700 text-sm">
                        @if (!$costs == '')
                            @foreach ($costs as $item)
                                <div class="">
                                    <label for="name">Layanan: {{ $item['name'] }}</label>

                                    @foreach ($item['costs'] as $cost)
                                        <div class="mb-3">
                                            <label for="service">Service: {{ $cost['service'] }}</label>

                                            @foreach ($cost['cost'] as $price)
                                                <div class="mb-3">
                                                    <label for="price">Harga: {{ $price['value'] }} (est:
                                                        {{ $price['etd'] }}) (hari)</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        @endif
                    </div> --}}

            <div id="total-akhir" class="mt-4 text-lg font-bold text-gray-800"></div>
            </div>

            <script>
                // Ambil daftar provinsi saat halaman dimuat
                fetch('/get-provinces')
                    .then(res => res.json())
                    .then(data => {
                        let provinsiSelect = document.getElementById('provinsi');
                        data.forEach(p => {
                            provinsiSelect.innerHTML += `<option value="${p.province_id}">${p.province}</option>`;
                        });
                    });

                // Ambil daftar kota saat provinsi dipilih
                document.getElementById('province').addEventListener('change', function() {
                    let provinceId = this.value;
                    fetch(`/get-cities/${provinceId}`)
                        .then(res => res.json())
                        .then(data => {
                            let kotaSelect = document.getElementById('destination');
                            kotaSelect.innerHTML = '<option value="">-- Pilih Kota --</option>';
                            data.forEach(k => {
                                kotaSelect.innerHTML += `<option value="${k.city_id}">${k.city_name}</option>`;
                            });
                        });
                });

                // Fungsi cek ongkir
                // function cekOngkir() {
                //     // let origin = 501; // ID kota asal, misalnya Semarang
                //     let destination = document.getElementById('kota').value;
                //     let weight = document.getElementById('berat').value;
                //     let courier = document.getElementById('kurir').value;
                //     const origin = document.getElementById('origin').value;

                //     // Validasi input
                //     if (!destination || !weight || !courier) {
                //         alert('Silakan isi semua field terlebih dahulu!');
                //         return;
                //     }

                //     // Kirim request ke server
                //     fetch('/cekot/checkout/check-shipping-cost', {
                //             method: 'POST',
                //             headers: {
                //                 'Content-Type': 'application/json',
                //                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
                //             },
                //             body: JSON.stringify({
                //                 origin,
                //                 destination,
                //                 weight,
                //                 courier
                //             })
                //         })
                //         .then(res => res.json())
                //         .then(data => {
                //             let hasil = document.getElementById('hasil-ongkir');
                //             hasil.innerHTML = '';

                //             if (data.error) {
                //                 hasil.innerHTML = `<p>${data.error}</p>`;
                //                 return;
                //             }

                //             data.forEach(service => {
                //                 let biaya = service.cost[0].value;
                //                 let etd = service.cost[0].etd;

                //                 hasil.innerHTML +=
                //                     `<p>${service.service} - Rp${biaya.toLocaleString('id-ID')} (${etd} hari)</p>`;

                //                 // Hitung total akhir
                //                 let totalAkhir = {{ $total }} + biaya;
                //                 document.getElementById('total-akhir').innerHTML =
                //                     `Total Akhir: <strong>Rp${totalAkhir.toLocaleString('id-ID')}</strong>`;
                //             });
                //         })
                //         .catch(err => {
                //             console.error('Gagal fetch ongkir:', err);
                //             alert('Terjadi kesalahan saat cek ongkir.');
                //         });
                // }
            </script>
            </div>
        </section>

        <!-- Sidebar Summary & Methods -->
        <aside class="space-y-6">
            <!-- Price Summary -->
            @php
                $subtotal = $total ?? 0; // 'total' dari controller checkout
            @endphp

            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Ringkasan Harga</h2>
                <dl class="space-y-2 text-sm text-gray-600">
                    <div class="flex justify-between">
                        <dt>Subtotal</dt>
                        <dd id="subtotal">Rp {{ number_format($subtotal, 0, ',', '.') }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt>Ongkir</dt>
                        <dd id="shippingCost">Rp 0</dd>
                    </div>
                </dl>
                <div class="border-t mt-4 pt-4 flex justify-between items-center">
                    <span class="font-medium text-gray-800">Total</span>
                    <span class="text-2xl font-bold text-gray-900" id="totalPrice">
                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                    </span>
                </div>
            </div>


            <!-- Shipping Method -->
            {{-- <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Metode Pengiriman</h2>
                <ul class="space-y-4">
                    <li>
                        <label
                            class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-brand transition focus-within:ring-2 focus-within:ring-brand">
                            <input type="radio" name="ship" value="reguler" checked
                                class="form-radio text-brand" />
                            <span class="ml-3 text-gray-700">Reguler (3–5 hari)</span>
                        </label>
                    </li>
                    <li>
                        <label
                            class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-brand transition focus-within:ring-2 focus-within:ring-brand">
                            <input type="radio" name="ship" value="express" class="form-radio text-brand" />
                            <span class="ml-3 text-gray-700">Express (1–2 hari)</span>
                        </label>
                    </li>
                </ul>
            </div> --}}

            <!-- Payment Method -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Metode Pembayaran</h2>
                <ul class="space-y-4">
                    {{-- <li>
                        <label
                            class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-brand transition focus-within:ring-2 focus-within:ring-brand">
                            <input type="radio" name="pay" value="bank" checked class="form-radio text-brand" />
                            <div class="ml-3 flex items-center space-x-2">
                                <img src="/assets/bca.png" alt="BCA" class="w-6 h-auto" />
                                <img src="/assets/mandiri.png" alt="Mandiri" class="w-6 h-auto" />
                                <img src="/assets/bni.png" alt="BNI" class="w-6 h-auto" />
                            </div>
                        </label>
                    </li>
                    <li> --}}
                    <label
                        class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-brand transition focus-within:ring-2 focus-within:ring-brand">
                        <input type="radio" name="pay" value="cod" class="form-radio text-brand" />
                        <span class="ml-3 text-gray-700">COD</span>
                    </label>
                    </li>
                    <li>
                        <label
                            class="flex items-center p-4 border border-gray-200 rounded-lg hover;border-brand transition focus-within:ring-2 focus-within:ring-brand">
                            <input type="radio" name="pay" value="midtrans" class="form-radio text-brand" />
                            <span class="ml-3 text-gray-700">Midtrans</span>
                        </label>
                    </li>
                </ul>
            </div>

            <!-- Pay Button -->
            <button
                class="w-full bg-brand text-white py-3 rounded-2xl font-semibold uppercase shadow-md hover:shadow-lg active:scale-95 transform transition">
                Pesan Sekarang
            </button>
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
    </div>     --}}
</body>
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


    // total
    function updateTotal() {
        const subtotal = {{ $subtotal }};
        const serviceSelect = document.getElementById('service');
        const shippingCost = parseInt(serviceSelect.options[serviceSelect.selectedIndex].dataset.cost || 0);

        // Update tampilan harga ongkir dan total
        document.getElementById('shippingCost').innerText = formatRupiah(shippingCost);
        document.getElementById('totalPrice').innerText = formatRupiah(subtotal + shippingCost);
    }

    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(number);
    }

    function updateTotal() {
        const subtotal = {{ $subtotal }};
        const serviceSelect = document.getElementById('service');
        const shippingCost = parseInt(serviceSelect.options[serviceSelect.selectedIndex].dataset.cost || 0);
        const total = subtotal + shippingCost;

        // Update tampilan desktop
        document.getElementById('shippingCost').innerText = formatRupiah(shippingCost);
        document.getElementById('totalPrice').innerText = formatRupiah(total);

        // Update tampilan mobile
        document.getElementById('mobileTotal').innerText = formatRupiah(total);

        // Kalau pakai input hidden untuk kirim total:
        const totalInput = document.getElementById('finalTotalInput');
        if (totalInput) {
            totalInput.value = total;
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

</html>
