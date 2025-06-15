<x-layout>
    <style>
        .review-img {
    max-width: 150px; /* Atur lebar maksimum yang Anda inginkan */
    height: auto;    /* Penting untuk menjaga rasio aspek */
    display: block;  /* Agar gambar tidak memiliki spasi ekstra di bawahnya */
    border-radius: 8px; /* Jika Anda ingin sudut melengkung */
    object-fit: cover; /* Untuk memastikan gambar mengisi area tanpa terdistorsi */
    margin-right: 15px; /* Menambahkan sedikit ruang di sebelah kanan gambar */
}

/* Anda mungkin juga ingin menyesuaikan tata letak review-card */
.review-card {
    display: flex; /* Menggunakan flexbox untuk tata letak gambar dan konten */
    align-items: flex-start; /* Mengatur item agar sejajar di bagian atas */
    gap: 15px; /* Memberi jarak antar gambar dan teks */
    padding: 20px;
    border: 1px solid #eee;
    border-radius: 10px;
    margin-bottom: 20px;
    background-color: #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

/* Opsional: gaya untuk review-container dan customer-review */
.customer-review {
    padding: 40px 0;
    background-color: #f9f9f9;
    text-align: center;
}

.customer-review h2 {
    margin-bottom: 30px;
    font-size: 2em;
    color: #333;
}

.review-container {
    max-width: 800px;
    margin: 0 auto;
    display: flex;
    flex-direction: column; /* Untuk menumpuk kartu review */
    gap: 20px;
}

.review-name {
    font-weight: bold;
    margin-bottom: 5px;
    color: #007bff; /* Warna biru untuk nama */
}

.stars {
    color: #ffc107; /* Warna bintang kuning */
    margin-bottom: 10px;
    font-size: 1.2em;
}

.review-text {
    color: #555;
    line-height: 1.6;
}
    </style>
    @foreach ($ratings as $rating)
        <section class="customer-review">
            <h2>{{ $rating->product->namaproduk }}</h2>
            <div class="review-container">
                <div class="review-card">
                    <img src="{{ asset('storage/' . $rating->product->photo) }}" alt="{{ $rating->name }}"
                        class="review-img"
                        style="max-width: 150px; height: auto; border-radius: 8px; object-fit: cover;" /> {{-- <--- TAMBAH / UBAH INI --}}
                    <div class="review-content">
                        <h3 class="review-name">{{ $rating->user->username ?? 'user' }}</h3>
                        <p class="stars">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $rating->rating)
                                    ⭐
                                @else
                                    ☆
                                @endif
                            @endfor
                        </p>
                        <p class="review-text">
                            {{ $rating->comment }}
                        </p>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
</x-layout>