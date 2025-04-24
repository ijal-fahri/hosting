<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
      <button onclick="history.back()" aria-label="Kembali" class="p-2 hover:bg-gray-100 rounded-lg transition-transform hover:scale-110">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
          <div class="w-6 h-6 flex items-center justify-center rounded-full bg-brand-light text-brand font-medium">1</div>
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
          <article class="flex flex-col sm:flex-row items-center py-6 hover:shadow-xl transition-transform transform hover:scale-105 rounded-lg bg-gray-50">
            <img src="/assets/baby.jpeg" alt="Produk Contoh" class="w-32 h-32 sm:w-36 sm:h-36 rounded-lg object-cover object-center" />
            <div class="flex-1 px-6 mt-4 sm:mt-0">
              <h3 class="text-lg font-semibold text-gray-700 hover:text-brand transition">Nama Produk Contoh</h3>
              <p class="text-sm text-gray-500 mt-1">Merah • M • 6–12 bulan</p>
              <div class="mt-4 inline-flex items-center bg-gray-100 rounded-full overflow-hidden">
                <button class="px-3 py-1 hover:bg-gray-200 transition"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20"><path d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z"/></svg></button>
                <span class="px-4 py-1 font-medium text-gray-700">1</span>
                <button class="px-3 py-1 hover:bg-gray-200 transition"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"/></svg></button>
              </div>
            </div>
            <div class="text-right mt-4 sm:mt-0">
              <p class="text-xl font-bold text-gray-900">Rp 150.000</p>
              <button class="mt-2 text-sm text-brand hover:underline">Ubah</button>
            </div>
          </article>
          <!-- Produk lain -->
        </div>
      </div>

      <!-- Shipping Address -->
      <div class="bg-white rounded-2xl shadow-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 border-b pb-3">Alamat Pengiriman</h2>
        <label for="address" class="block text-sm font-medium text-gray-600 mt-4">Alamat Lengkap</label>
        <input id="address" type="text" placeholder="Jl. Contoh No. 123, Jakarta" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand focus:border-transparent transition" />
        <div class="w-full h-48 rounded-lg overflow-hidden mt-4">
          <iframe src="https://maps.google.com/maps?q=Jl.+Contoh+No.+123,+Jakarta&amp;output=embed" class="w-full h-full" loading="lazy"></iframe>
        </div>
      </div>
    </section>

    <!-- Sidebar Summary & Methods -->
    <aside class="space-y-6">
      <!-- Price Summary -->
      <div class="bg-white rounded-2xl shadow-lg p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Ringkasan Harga</h2>
        <dl class="space-y-2 text-sm text-gray-600">
          <div class="flex justify-between"><dt>Subtotal</dt><dd>Rp 150.000</dd></div>
          <div class="flex justify-between"><dt>Ongkir</dt><dd>Rp 10.000</dd></div>
          <div class="flex justify-between"><dt>Voucher</dt><dd class="text-green-600">- Rp 5.000</dd></div>
        </dl>
        <div class="border-t mt-4 pt-4 flex justify-between items-center">
          <span class="font-medium text-gray-800">Total</span>
          <span class="text-2xl font-bold text-gray-900">Rp 155.000</span>
        </div>
      </div>

      <!-- Shipping Method -->
      <div class="bg-white rounded-2xl shadow-lg p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Metode Pengiriman</h2>
        <ul class="space-y-4">
          <li>
            <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-brand transition focus-within:ring-2 focus-within:ring-brand">
              <input type="radio" name="ship" value="reguler" checked class="form-radio text-brand" />
              <span class="ml-3 text-gray-700">Reguler (3–5 hari)</span>
            </label>
          </li>
          <li>
            <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-brand transition focus-within:ring-2 focus-within:ring-brand">
              <input type="radio" name="ship" value="express" class="form-radio text-brand" />
              <span class="ml-3 text-gray-700">Express (1–2 hari)</span>
            </label>
          </li>
        </ul>
      </div>

      <!-- Payment Method -->
      <div class="bg-white rounded-2xl shadow-lg p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Metode Pembayaran</h2>
        <ul class="space-y-4">
          <li>
            <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-brand transition focus-within:ring-2 focus-within:ring-brand">
              <input type="radio" name="pay" value="bank" checked class="form-radio text-brand" />
              <div class="ml-3 flex items-center space-x-2">
                <img src="/assets/bca.png" alt="BCA" class="w-6 h-auto" />
                <img src="/assets/mandiri.png" alt="Mandiri" class="w-6 h-auto" />
                <img src="/assets/bni.png" alt="BNI" class="w-6 h-auto" />
              </div>
            </label>
          </li>
          <li>
            <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-brand transition focus-within:ring-2 focus-within:ring-brand">
              <input type="radio" name="pay" value="cod" class="form-radio text-brand" />
              <span class="ml-3 text-gray-700">COD</span>
            </label>
          </li>
          <li>
            <label class="flex items-center p-4 border border-gray-200 rounded-lg hover;border-brand transition focus-within:ring-2 focus-within:ring-brand">
              <input type="radio" name="pay" value="midtrans" class="form-radio text-brand" />
              <span class="ml-3 text-gray-700">Midtrans</span>
            </label>
          </li>
        </ul>
      </div>

      <!-- Pay Button -->
      <button class="w-full bg-brand text-white py-3 rounded-2xl font-semibold uppercase shadow-md hover:shadow-lg active:scale-95 transform transition">
        Bayar Sekarang
      </button>
    </aside>
  </main>

  <!-- Mobile Footer Bar -->
  <div class="lg:hidden fixed bottom-0 left-0 w-full bg-white shadow-inner border-t">
    <div class="flex items-center justify-between max-w-7xl mx-auto px-6 py-4">
      <div>
        <p class="text-sm text-gray-600">Total</p>
        <p class="text-lg font-bold text-gray-900">Rp 155.000</p>
      </div>
      <button class="bg-brand text-white px-6 py-2 rounded-2xl font-semibold uppercase shadow-md hover:shadow-lg active:scale-95 transition">
        Bayar
      </button>
    </div>
  </div>
</body>
</html>
