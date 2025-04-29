

<x-layout>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zoes Store</title>
  <style>
    /* Animasi Fade-In */
    .fade-in {
      opacity: 0;
      animation: fadeInAnimation 0.5s forwards;
    }
    @keyframes fadeInAnimation {
      to { opacity: 1; }
    }

    /* --- HERO SECTION --- */
    .hero {
      display: flex;                  
      align-items: center;            
      justify-content: space-between; 
      max-width: 1200px;             
      margin: 0 auto;                
      padding: 80px 2rem;            
    }
    .hero-text {
      flex: 1;
      max-width: 50%;
      text-align: left;
    }
    .hero-text h1 {
      font-size: 50px;
      font-weight: 900;
      line-height: 1.2;
      margin-bottom: 20px;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }
    .hero-text p {
      font-size: 18px;
      color: #333;
      margin-bottom: 20px;
    }
    .btn {
      background: black;
      color: white;
      padding: 12px 24px;
      border: none;
      cursor: pointer;
      font-size: 16px;
      font-weight: bold;
      border-radius: 8px;
      text-transform: uppercase;
      transition: all 0.3s ease;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
      display: inline-block;
      text-decoration: none;
    }
    .btn:hover {
      background: #333;
      box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.3);
    }
    .hero-image {
      flex: 1;
      max-width: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .hero-image img {
      width: 100%;
      max-width: 400px;
      height: auto;
    }
    @media (max-width: 768px) {
      .hero {
        flex-direction: column;
        padding: 40px 1rem;
      }
      .hero-text, .hero-image {
        max-width: 100%;
        text-align: center;
      }
      .hero-text h1 {
        font-size: 36px;
      }
    }

    /* --- PAYMENT METHODS --- */
    .payment-methods {
      position: relative;
      left: 50%;
      right: 50%;
      margin-left: -50vw;
      margin-right: -50vw;       
      width: 100vw;
      background: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(10px);
      border-radius: 15px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
      margin-top: 2rem;
      margin-bottom: 2rem;
      overflow: hidden;
    }
    .payment-inner {
      max-width: 1200px;
      margin: 0 auto;
      padding: 30px;
      display: flex;
      flex-direction: column;
      align-items: center;
      flex-wrap: wrap;
    }
    .payment-title {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
      color: #333;
      text-align: center;
    }
    .payment-icons {
      display: flex;
      gap: 15px;
      justify-content: center;
      flex-wrap: wrap;
    }
    .payment-icons img {
      width: 80px;
      height: auto;
      border-radius: 15px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s ease-in-out;
    }
    .payment-icons img:hover {
      transform: scale(1.1);
    }

    /* --- BABY SHOES SECTION --- */
    .baby-shoes {
      text-align: center;
      padding: 20px;
    }
    .products-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
    }
    .product-card {
      position: relative;
      width: 260px;
      padding: 15px;
      border: 1px solid #ddd;
      border-radius: 12px;
      text-align: left;
      background: #fff;
      box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
    }
    .price-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 10px;
    }
    .product-image {
      width: 100%;
      height: 180px;
      border-radius: 8px;
      object-fit: contain;
      display: block;
      margin: 10px auto;
    }
    .product-card h3 {
      font-size: 16px;
      margin: 10px 0;
    }
    .price {
      font-size: 16px;
      font-weight: bold;
    }
    .buy {
      width: 40px;
      height: 40px;
      font-size: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

/* SECTION WRAPPER */
.explore-section {
  background-color: #f8f8f8; /* Latar belakang luar (halaman) */
  padding: 40px 0;
  display: flex;
  justify-content: center;   /* Posisikan container di tengah */
}

/* CONTAINER UTAMA (Latar hitam) */
.explore-container {
  background-color: #000;    /* Latar hitam */
  color: #fff;               /* Teks putih */
  max-width: 1000px;         /* Lebar maksimal */
  width: 100%;
  margin: 0 20px;
  padding: 20px;
  border-radius: 16px;
  
  /* Menggunakan grid 2 kolom */
  display: grid;
  grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
  gap: 20px;
  align-items: center;       /* Vertikal selaras */
}

/* BAGIAN GAMBAR (kiri) */
.explore-images {
  display: flex;
  flex-wrap: wrap;           /* Supaya gambar dapat membungkus ke baris baru jika sempit */
  gap: 10px;
  justify-content: center;   /* Gambar di tengah */
}
.main-image {
  width: 100%;               /* Biarkan gambar skala lebar parent */
  max-width: 200px;          /* Batas maksimal */
  height: auto;
  border-radius: 8px;
  object-fit: cover;
}

/* BAGIAN TEKS (kanan) */
.explore-text h2 {
  margin-bottom: 10px;
  line-height: 1.3;
  font-size: 28px;
}
.explore-text p {
  margin-bottom: 20px;
}
.explore-button {
  background: #fff;
  color: #000;
  padding: 10px 20px;
  font-weight: 600;
  border-radius: 4px;
  text-decoration: none;
  transition: 0.3s;
}
.explore-button:hover {
  background: #ddd;
}

/* THUMBNAIL (opsional) */
.thumbnail-container {
  display: flex;
  gap: 10px;
  margin-top: 20px;
}
.thumbnail-container img {
  width: 50px;
  height: 50px;
  object-fit: cover;
  border-radius: 4px;
  transition: transform 0.3s, box-shadow 0.3s;
}
.thumbnail-container img:hover {
  transform: scale(1.1);
  box-shadow: 0 0 8px rgba(255, 255, 255, 0.5);
}

/* RESPONSIVE */
@media (max-width: 600px) {
  .explore-container {
    /* Jadi 1 kolom kalau layar sangat sempit */
    grid-template-columns: 1fr;
    text-align: center;
  }
  .explore-images {
    justify-content: center;
  }
  .main-image {
    max-width: 160px; /* Bisa lebih kecil di layar sempit */
  }
}


    /* --- BEST SELLING SECTION --- */
    .best-selling {
      text-align: center;
      padding: 40px 20px;
    }
    .badge {
      position: absolute;
      top: 10px;
      left: 10px;
      background: black;
      color: white;
      padding: 5px 10px;
      font-size: 12px;
      border-radius: 5px;
    }
    .best-selling .product-image {
      width: 100%;
      height: 200px;
      border-radius: 8px;
      object-fit: contain;
      display: block;
      margin: 10px auto 15px;
    }
    .best-selling .product-card h3 {
      font-size: 18px;
      margin: 10px 0;
    }
    .old-price {
      text-decoration: line-through;
      color: gray;
      margin-left: 10px;
    }
    .actions {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
    }
    .like,
    .buy {
      background: none;
      border: none;
      font-size: 20px;
      cursor: pointer;
    }
    .buy {
      background: black;
      color: white;
      border-radius: 50%;
      width: 30px;
      height: 30px;
    }

    /* --- CUSTOMER REVIEW SECTION --- */
    .customer-review {
      text-align: center;
      margin-bottom: 50px;
    }
    .customer-review h2 {
      font-size: 24px;
      margin-bottom: 40px;
      font-weight: 600;
    }
    .review-container {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 30px;
      padding: 0 20px;
    }
    .review-card {
      display: flex;
      align-items: center;
      gap: 20px;
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      max-width: 600px;
      width: 100%;
      padding: 20px;
      text-align: left;
    }
    .review-img {
      width: 150px;
      height: 200px;
      object-fit: cover;
      border-radius: 12px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .review-content {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }
    .review-name {
      font-size: 20px;
      font-weight: bold;
      margin: 0;
    }
    .stars {
      font-size: 16px;
      color: #f5c518;
      margin: 0;
    }
    .review-text {
      font-size: 14px;
      color: #555;
      line-height: 1.5;
      margin: 0;
    }
    @media (max-width: 768px) {
      .review-card {
        flex-direction: column;
        align-items: center;
        text-align: center;
      }
      .review-img {
        width: 80%;
        height: auto;
      }
    }
  </style>
</head>
<body>
  <!-- HERO SECTION -->
  <section class="hero">
    <div class="hero-text">
      <h1>SELAMAT DATANG DI ZOES STORE!</h1>
      <p>Koleksi Sepatu Stylish Untuk Si Kecil, Anak Perempuan & Laki-Laki!</p>
    </div>
    <div class="hero-image">
      <img src="{{ asset('/assets/shozo.png') }}" alt="Sepatu">
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