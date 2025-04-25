<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Pastikan Font Awesome sudah di-load -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-jQ3xE3yWXl87E1+u7hA7K1T9oiBLrxKQiS66dKvX5y6LStf6UR4ft056xFxo955Q7LMV+pJcWznYQlLFNV2eXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <x-layout>
        <section class="best-selling">
            <h2 class="title">— Page Shoop —</h2>
            <div class="products-container">
                @forelse($products as $product)
                    <div class="product-card">
                        <div class="top-icons">
                            <i class="fas fa-shopping-cart"></i>
                            <i class="far fa-heart"></i>
                        </div>

                        <span class="badge">{{ $product->status == 'aktif' ? 'Best Seller' : 'Tidak Aktif' }}</span>

                        @if ($product->photo)
                            <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}"
                                class="product-image">
                        @else
                            <img src="{{ asset('/assets/default.png') }}" alt="No Image" class="product-image">
                        @endif

                        <h3>{{ $product->name }}</h3>
                        <p class="price">
                            Rp{{ number_format($product->harga_diskon ?? $product->price, 0, ',', '.') }}
                            @if ($product->diskon)
                                <span class="old-price">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                            @endif
                        </p>
                        <div class="desc-row">
                            <p class="description">
                                {{ Str::limit($product->description, 80) }}
                            </p>
                            <a href="{{ route('produkdetail.index', ['id' => $product->id]) }}" class="buy">↗</a>
                        </div>
                    </div>
                @empty
                    <p>Tidak ada produk tersedia.</p>
                @endforelse
            </div>
        </section>

        <style>
            /* Import SF Pro Font */
            @import url('https://fonts.googleapis.com/css2?family=SF+Pro:wght@400;600;700&display=swap');

            body {
                font-family: 'SF Pro', -apple-system, BlinkMacSystemFont, 'Helvetica Neue', Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f7f7f7;
            }

            /* Section Wrapper */
            .best-selling {
                text-align: center;
                padding: 40px 20px;
            }

            .title {
                margin-bottom: 40px;
                font-size: 24px;
                font-weight: 700;
            }

            /* Container Produk */
            .products-container {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 20px;
                max-width: 1200px;
                margin: 0 auto;
            }

            /* Card Produk */
            .product-card {
                position: relative;
                width: 320px;
                padding: 20px;
                border: 1px solid #ddd;
                border-radius: 12px;
                text-align: left;
                background: #fff;
                box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            }

            /* Ikon Cart dan Love di pojok kanan atas */
            .top-icons {
                position: absolute;
                top: 10px;
                right: 10px;
                display: flex;
                gap: 10px;
            }

            /* Style ikon Font Awesome */
            .top-icons i {
                color: #333;
                font-size: 18px;
                cursor: pointer;
            }

            /* Badge */
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

            /* Gambar Produk */
            .product-image {
                width: 100%;
                height: 200px;
                border-radius: 8px;
                object-fit: contain;
                display: block;
                margin: 10px auto 15px;
            }

            /* Judul Produk */
            .product-card h3 {
                font-size: 18px;
                margin: 10px 0;
                font-weight: 600;
            }

            /* Harga Produk */
            .price {
                font-size: 16px;
                font-weight: bold;
            }

            /* Harga Lama dengan Coret */
            .old-price {
                text-decoration: line-through;
                color: gray;
                margin-left: 10px;
                font-weight: normal;
            }

            /* Baris Deskripsi dan Tombol Buy */
            .desc-row {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-top: 10px;
            }

            .description {
                margin: 0;
                color: #555;
                font-size: 14px;
                line-height: 1.4;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                /* Batasi maksimal 2 baris */
                -webkit-box-orient: vertical;
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: 220px;
                /* Pastikan ada ruang untuk tombol buy */
            }

            /* Tombol aksi (Buy) */
            .buy {
                background: black;
                color: white;
                border-radius: 50%;
                width: 30px;
                height: 30px;
                display: flex;
                align-items: center;
                justify-content: center;
                text-decoration: none;
                font-size: 20px;
                border: none;
                cursor: pointer;
                flex-shrink: 0;
                margin-left: 10px;
            }

            /* RESPONSIVE */
            @media (max-width: 1024px) {
                .products-container {
                    justify-content: center;
                    padding: 30px;
                }
            }

            @media (max-width: 768px) {
                .products-container {
                    flex-direction: column;
                    align-items: center;
                }

                .product-card {
                    width: 90%;
                    max-width: 350px;
                    margin-bottom: 20px;
                }

                .description {
                    max-width: 65%;
                }
            }
        </style>
    </x-layout>
</body>

</html>
