<x-layout>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zoes Store</title>
  <link href="{{ asset('asset-landing-admin/css/dashboard-user.css') }}" rel="stylesheet" />
</head>
<body>
  <!-- HERO SECTION -->
  <section class="hero">
    <div class="hero-text">
      <h1>WELCOME TO ZOES STORE!</h1>
      <p>Koleksi Sepatu Stylish Untuk Si Kecil, Anak Perempuan & Laki-Laki!</p>
      <a href="/shop" class="btn no-underline">Shop Now</a>
    </div>
    <div class="hero-image">
      <img src="{{ asset('/assets/shozo.png') }}" alt="Sepatu">
    </div>
  </section>


<!-- EXPLORE SECTION (Are you ready) -->
<section class="explore-section">
  <div class="explore-container">
    <!-- Bagian gambar di sisi kiri -->
    <div class="explore-images">
      <img src="{{ asset('/assets/baby.jpeg') }}" alt="Sepatu 1" class="main-image">
      <img src="{{ asset('/assets/baby.jpeg') }}" alt="Sepatu 2" class="main-image">
    </div>

    <!-- Bagian teks di sisi kanan -->
    <div class="explore-text">
      <h2>Are you ready <br> to <strong>ZOES STORE</strong></h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do.</p>
      <a href="#" class="explore-button">Explore</a>
      
      <!-- Thumbnails (opsional) -->
      <div class="thumbnail-container">
        <img src="{{ asset('/assets/baby.jpeg') }}" alt="Thumbnail 1">
        <img src="{{ asset('/assets/baby.jpeg') }}" alt="Thumbnail 2">
        <img src="{{ asset('/assets/baby.jpeg') }}" alt="Thumbnail 3">
      </div>
    </div>
  </div>
</section>

  <!-- BEST SELLING SECTION -->
  <section class="best-selling">
    <h2 class="title">— Best Selling —</h2>
    <div class="products-container" id="bestsellingProducts">
      <div class="product-card fade-in" data-category="bestselling" data-name="sepatu dewasa">
        <span class="badge">Best Seller</span>
        <img src="{{ asset('/assets/baby.jpeg')}}" alt="Sepatu Dewasa" class="product-image">
        <h3>Sepatu Dewasa</h3>
        <p class="price">₹ 3499.00 <span class="old-price">₹ 5999.00</span></p>
        <div class="actions">
          <button class="like">❤️</button>
          <button class="buy">↗</button>
        </div>
      </div>
      <div class="product-card fade-in" data-category="bestselling" data-name="sepatu sport">
        <span class="badge">Best Seller</span>
        <img src="{{ asset('/assets/baby.jpeg')}}" alt="Sepatu Sport" class="product-image">
        <h3>Sepatu Sport</h3>
        <p class="price">₹ 3999.00 <span class="old-price">₹ 6999.00</span></p>
        <div class="actions">
          <button class="like">❤️</button>
          <button class="buy">↗</button>
        </div>
      </div>
      <div class="product-card fade-in" data-category="bestselling" data-name="sepatu casual">
        <span class="badge">Best Seller</span>
        <img src="{{ asset('/assets/baby.jpeg')}}" alt="Sepatu Casual" class="product-image">
        <h3>Sepatu Casual</h3>
        <p class="price">₹ 2999.00 <span class="old-price">₹ 4999.00</span></p>
        <div class="actions">
          <button class="like">❤️</button>
          <button class="buy">↗</button>
        </div>
      </div>
    </div>
  </section>

  <!-- CUSTOMER REVIEW SECTION -->
  <section class="customer-review">
    <h2>— Customer Review —</h2>
    <div class="review-container">
      <div class="review-card">
        <img src="{{ asset('/assets/vies.jpeg') }}" alt="Ava Joshi" class="review-img" />
        <div class="review-content">
          <h3 class="review-name">Ava Joshi</h3>
          <p class="stars">⭐⭐⭐⭐☆</p>
          <p class="review-text">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod 
            tempor incididunt ut labore et dolore magna aliqua.
          </p>
        </div>
      </div>
      <div class="review-card">
        <img src="{{ asset('/assets/vies.jpeg') }}" alt="Otis Bisnoy" class="review-img" />
        <div class="review-content">
          <h3 class="review-name">Otis Bisnoy</h3>
          <p class="stars">⭐⭐⭐⭐☆</p>
          <p class="review-text">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod 
            tempor incididunt ut labore et dolore magna aliqua.
          </p>
        </div>
      </div>
    </div>
  </section>
</body>
</html>
</x-layout>