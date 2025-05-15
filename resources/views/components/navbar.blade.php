<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Responsive Navbar</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome -->
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    rel="stylesheet"
  />
</head>
<body class="bg-gray-100">

<!-- Navbar -->
<nav class="bg-black text-white px-6 py-4">
  <div class="flex justify-between items-center">
    <!-- Logo / Brand -->
    <div class="text-lg font-bold">ZOES</div>

    <!-- Hamburger Button (Mobile) -->
    <button id="mobileMenuBtn" class="lg:hidden focus:outline-none">
      <i class="fas fa-bars text-xl"></i>
    </button>

    <!-- Menu Desktop -->
    <div class="hidden lg:flex space-x-4 items-center" id="desktopMenu">
      <a href="{{ route('dashboard') }}"
         class="px-4 py-2 rounded-md text-sm font-semibold hover:bg-gray-700 transition duration-200">
        Back
      </a>


  <!-- Mobile Menu -->
  <div class="lg:hidden mt-4 space-y-2 hidden" id="mobileMenu">
    <a href="{{ route('dashboard') }}"
       class="block px-4 py-2 rounded-md text-sm font-semibold hover:bg-gray-700 transition duration-200">
      Back
    </a>


    <!-- Riwayat (dropdown lookalike for mobile) -->
    <div class="space-y-1">
      <div class="px-4 py-2 font-semibold">Riwayat</div>
      <a href="{{ route('riwayat.transaksi.trans') }}"
         class="block px-6 py-1 text-sm hover:bg-gray-700">Riwayat Transaksi</a>
      <a href="{{ route('riwayat.pemesanan.pesanan') }}"
         class="block px-6 py-1 text-sm hover:bg-gray-700">Riwayat Pesanan</a>
    </div>
  </div>
</nav>

<!-- Script -->
<script>
  // Dropdown for desktop
  const aboutBtn = document.getElementById('aboutBtn');
  const aboutDropdown = document.getElementById('aboutDropdown');
  const riwayatBtn = document.getElementById('riwayatBtn');
  const riwayatDropdown = document.getElementById('riwayatDropdown');

  aboutBtn?.addEventListener('click', function (e) {
    e.stopPropagation();
    aboutDropdown.classList.toggle('hidden');
    riwayatDropdown.classList.add('hidden');
  });

  riwayatBtn?.addEventListener('click', function (e) {
    e.stopPropagation();
    riwayatDropdown.classList.toggle('hidden');
    aboutDropdown.classList.add('hidden');
  });

  document.addEventListener('click', function () {
    aboutDropdown.classList.add('hidden');
    riwayatDropdown.classList.add('hidden');
  });

  // Toggle mobile menu
  const mobileMenuBtn = document.getElementById('mobileMenuBtn');
  const mobileMenu = document.getElementById('mobileMenu');

  mobileMenuBtn?.addEventListener('click', function () {
    mobileMenu.classList.toggle('hidden');
  });
</script>

</body>
</html>


<div class="id">
    {{ $slot }}  
</div>
</div>
