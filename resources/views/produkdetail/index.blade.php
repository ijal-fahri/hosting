<x-layout>
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Detail Produk Sepatu Balita - Tokoku</title>

        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('asset-landing-admin/css/produkdetail.css') }}"">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
            integrity="sha512-zsNfQSmT6e95InHCXcmvNt95hK8mCs2+X6Qa8zJ8bHkqOM59wjYFSb6nKyekD+63XVDxwkStzUrLEbH1cj6FMA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    </header>

    <main class="container mx-auto p-6 mt-6 space-y-10">
        <!-- Produk Detail -->
        <div class="bg-white rounded-lg shadow-xl p-6 md:flex">
            <a href="/shop" style="font-weight: bold;">Back</a>
            <!-- Gambar Produk -->
            <div class="md:w-1/2 flex justify-center items-center relative">
                <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}"
                    class="w-full md:w-96 rounded-lg transform hover:scale-105 transition duration-300" />
                <!-- Badge Flash Sale -->
            </div>
            <!-- Informasi Produk -->
            <div class="md:w-1/2 mt-6 md:mt-0 md:ml-8">
                <h2 class="text-3xl font-extrabold text-gray-900">{{ $product->name }}</h2>
                <p class="mt-3 text-red-500 line-through">
                    Rp.{{ number_format($product->price, 0, ',', '.') }}
                </p>
                <span class="inline-block bg-yellow-500 text-black font-semibold px-4 py-2 rounded-full">
                    Diskon Produk {{ $product->diskon ?? '-' }} %
                </span>
                <p class="text-3xl font-bold text-red-500">Rp. {{ number_format($product->harga_diskon, 0, ',', '.') }}
                </p>
                <p class="mt-3 text-gray-700"><strong>Stock Produk</strong> {{ $product->stock ?? '-' }}</p>
                <!-- Info Pengiriman & Jaminan -->
                <hr class="my-5" />
                <!-- Tab Informasi -->
                <div>
                    <ul class="flex border-b">
                        <li class="mr-1">
                            <a class="bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold cursor-pointer"
                                onclick="showTab('descTab')">Deskripsi</a>
                        </li>
                    </ul>
                    <!-- Konten Tab -->
                    <div class="pt-4">
                        <div id="descTab" class="tab-content">
                            <h3 class="text-xl font-bold mb-2">Deskripsi Produk</h3>
                            <p class="text-gray-700">{{ $product->description }}</p>
                        </div>
                        <div id="reviewTab" class="tab-content hidden">
                            <h3 class="text-xl font-bold mb-2">Ulasan Produk</h3>
                            <div id="reviewsContainer" class="space-y-5">
                                <!-- Review contoh default -->
                                <div class="flex items-center gap-5 bg-gray-100 p-5 rounded-lg shadow-md">
                                    <img src="https://storage.googleapis.com/a1aa/image/HQVbSqNxpu57RlWeroegchvsBYrKONfVWPXfYtOWD3I.jpg"
                                        alt="User" class="w-14 h-14 rounded-full shadow-lg" />
                                    <div>
                                        <p class="font-bold text-lg">
                                            Otis <span class="text-yellow-500">★★★★☆</span>
                                        </p>
                                        <p class="text-gray-600">Sepatu ini sangat bagus dan nyaman.</p>
                                    </div>
                                </div>
                                <!-- Review akan dimuat secara dinamis melalui script -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tombol Aksi -->
                <div class="mt-6 grid grid-cols-2 gap-4">
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-black to-gray-800 text-white py-3 px-8 rounded-lg shadow-lg hover:scale-105 transition">
                            Tambah Keranjang
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </main>


    <!-- Script Utama -->
    <script>
        // ===============================================
        // Konstanta & Variabel
        // ===============================================
        const purchased = true; // Ubah ke false jika user belum membeli
        const itemCode = "SBALITA-001"; // Code produk
        const STORAGE_KEY = reviewsData_$ {
            itemCode
        };
        let reviewsData = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];

        // ===============================================
        // Fungsi Tab untuk Deskripsi, Spesifikasi, Review
        // ===============================================
        function showTab(tabId) {
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.add('hidden');
            });
            document.getElementById(tabId).classList.remove('hidden');
        }
        // Inisialisasi Tab awal
        showTab('descTab');

        // ===============================================
        // Render Reviews di dua tempat (Tab & Section Review)
        // ===============================================
        function renderReviews() {
            const reviewsContainer = document.getElementById("reviewsContainer2");
            reviewsContainer.innerHTML = "";
            reviewsData.forEach(rv => {
                const div = document.createElement("div");
                div.className = "flex items-center gap-5 bg-gray-100 p-5 rounded-lg shadow-md mt-3";

                const img = document.createElement("img");
                img.src = rv.photo ? rv.photo : "https://via.placeholder.com/56";
                img.className = "w-14 h-14 rounded-full shadow-lg";

                const infoDiv = document.createElement("div");
                const title = document.createElement("p");
                title.innerHTML = $ {
                    rv.name
                } < span class = "text-yellow-500" > $ {
                    "★".repeat(rv.rating)
                }
                $ {
                    "☆".repeat(5 - rv.rating)
                } < /span>;
                title.className = "font-bold text-lg";

                const text = document.createElement("p");
                text.textContent = rv.text;
                text.className = "text-gray-600";

                const actions = document.createElement("div");
                actions.className = "mt-2";

                const editBtn = document.createElement("button");
                editBtn.className = "review-action";
                editBtn.innerHTML = '<i class="fas fa-edit"></i> Edit';
                editBtn.addEventListener("click", () => editReview(rv.id));

                const deleteBtn = document.createElement("button");
                deleteBtn.className = "review-action";
                deleteBtn.innerHTML = '<i class="fas fa-trash"></i> Hapus';
                deleteBtn.addEventListener("click", () => deleteReview(rv.id));

                actions.appendChild(editBtn);
                actions.appendChild(deleteBtn);

                infoDiv.appendChild(title);
                infoDiv.appendChild(text);
                infoDiv.appendChild(actions);

                div.appendChild(img);
                div.appendChild(infoDiv);

                reviewsContainer.appendChild(div);
            });
        }
        // Panggil renderReviews saat load
        renderReviews();

        // ===============================================
        // Section Review (Form review)
        // ===============================================
        const reviewFormContainer = document.getElementById("reviewFormContainer");
        if (!purchased) {
            const msg = document.createElement("p");
            msg.className = "text-red-500 font-semibold";
            msg.textContent = "Anda belum pernah membeli barang ini. Tidak bisa memberikan ulasan.";
            reviewFormContainer.appendChild(msg);
        } else {
            reviewFormContainer.innerHTML = `
        `;

            const reviewForm = document.getElementById("reviewForm");
            const starContainer = document.getElementById("starContainer");
            const stars = starContainer.querySelectorAll(".star");
            let currentRating = 0;

            stars.forEach(star => {
                star.addEventListener("click", () => {
                    currentRating = parseInt(star.getAttribute("data-value"));
                    stars.forEach(s => {
                        s.classList.toggle("selected", parseInt(s.getAttribute("data-value")) <=
                            currentRating);
                    });
                });
            });

            const reviewPhoto = document.getElementById("reviewPhoto");
            const photoPreview = document.getElementById("photoPreview");
            const photoSizeSlider = document.getElementById("photoSizeSlider");
            let previewImgEl = null;

            reviewPhoto.addEventListener("change", () => {
                photoPreview.innerHTML = "";
                if (reviewPhoto.files && reviewPhoto.files.length > 0) {
                    const file = reviewPhoto.files[0];
                    const imgUrl = URL.createObjectURL(file);
                    previewImgEl = document.createElement("img");
                    previewImgEl.src = imgUrl;
                    previewImgEl.className = "object-cover rounded border border-gray-300";
                    previewImgEl.style.width = photoSizeSlider.value + "px";
                    photoPreview.appendChild(previewImgEl);
                }
            });

            photoSizeSlider.addEventListener("input", (e) => {
                if (previewImgEl) {
                    previewImgEl.style.width = e.target.value + "px";
                }
            });

            reviewForm.addEventListener("submit", function(e) {
                e.preventDefault();
                if (currentRating === 0) {
                    Swal.fire({
                        title: "Mohon beri rating bintang!",
                        icon: "warning",
                        confirmButtonText: "OK"
                    });
                    return;
                }

                const reviewName = document.getElementById("reviewName").value.trim();
                const reviewText = this.querySelector("textarea").value.trim();
                let reviewPhotoURL = "";

                if (reviewPhoto.files && reviewPhoto.files.length > 0) {
                    const file = reviewPhoto.files[0];
                    const reader = new FileReader();
                    reader.onload = function(evt) {
                        reviewPhotoURL = evt.target.result;
                        saveReviewToStorage(reviewName, currentRating, reviewText, reviewPhotoURL);
                    };
                    reader.readAsDataURL(file);
                } else {
                    saveReviewToStorage(reviewName, currentRating, reviewText, "");
                }
            });

            function saveReviewToStorage(name, rating, text, photo) {
                const newReview = {
                    id: Date.now(),
                    name,
                    rating,
                    text,
                    photo
                };
                reviewsData.push(newReview);
                localStorage.setItem(STORAGE_KEY, JSON.stringify(reviewsData));
                Swal.fire({
                        title: "Review berhasil ditambahkan!",
                        icon: "success",
                        timer: 1500,
                        showConfirmButton: false
                    })
                    .then(() => {
                        reviewForm.reset();
                        photoPreview.innerHTML = "";
                        stars.forEach(s => s.classList.remove("selected"));
                        currentRating = 0;
                        renderReviews();
                    });
            }

            function editReview(reviewId) {
                const review = reviewsData.find(r => r.id === reviewId);
                if (!review) return;
                Swal.fire({
                    title: "Edit Review",
                    html: < textarea id = "swal-input"
                    class = "swal2-textarea"
                    placeholder = "Ubah review Anda di sini..." > $ {
                        review.text
                    } < /textarea>,
                    focusConfirm: false,
                    showCancelButton: true,
                    preConfirm: () => {
                        const newText = document.getElementById("swal-input").value.trim();
                        if (!newText) {
                            Swal.showValidationMessage("Review tidak boleh kosong!");
                        }
                        return newText;
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        review.text = result.value;
                        localStorage.setItem(STORAGE_KEY, JSON.stringify(reviewsData));
                        renderReviews();
                        Swal.fire({
                            title: "Review berhasil diupdate!",
                            icon: "success",
                            timer: 1200,
                            showConfirmButton: false
                        });
                    }
                });
            }

            function deleteReview(reviewId) {
                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Review akan dihapus secara permanen.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        reviewsData = reviewsData.filter(r => r.id !== reviewId);
                        localStorage.setItem(STORAGE_KEY, JSON.stringify(reviewsData));
                        renderReviews();
                        Swal.fire({
                            title: "Review telah dihapus!",
                            icon: "success",
                            timer: 1200,
                            showConfirmButton: false
                        });
                    }
                });
            }

            // Pastikan tombol edit dan hapus tersedia saat render
            window.editReview = editReview;
            window.deleteReview = deleteReview;
        }

        // ===============================================
        // Fungsi Modal Beli Sekarang & Pilihan
        // ===============================================
        let selectedColorValue = "";
        let selectedSizeValue = "";

        function toggleBuyNowModal(show) {
            const modal = document.getElementById("buyNowModal");
            if (show) {
                modal.classList.remove("hidden");
                setTimeout(() => modal.classList.add("show"), 10);
            } else {
                modal.classList.remove("show");
                setTimeout(() => modal.classList.add("hidden"), 400);
            }
        }

        function selectColor(colorName) {
            selectedColorValue = colorName;
            document.getElementById("selectedColor").innerHTML = Warna yang dipilih: < span class = "font-bold" > $ {
                colorName
            } < /span>;
        }

        function selectSize(e, size) {
            e.preventDefault();
            selectedSizeValue = size;
            document.querySelectorAll("#sizeOptions button").forEach(btn => btn.classList.remove("bg-gray-200", "ring-2",
                "ring-black"));
            e.target.classList.add("bg-gray-200", "ring-2", "ring-black");
            document.getElementById("selectedSize").innerHTML = Ukuran yang dipilih: < span class = "font-bold" > $ {
                size
            } < /span>;
        }

        function updateQty(val) {
            const qtyInput = document.getElementById("quantityInput");
            let currentVal = parseInt(qtyInput.value) || 1;
            qtyInput.value = Math.max(currentVal + val, 1);
        }

        function goToCheckout() {
            if (!selectedColorValue) {
                Swal.fire({
                    title: "Harap pilih warna dahulu!",
                    icon: "warning",
                    confirmButtonText: "OK"
                });
                return;
            }
            if (!selectedSizeValue) {
                Swal.fire({
                    title: "Harap pilih ukuran dahulu!",
                    icon: "warning",
                    confirmButtonText: "OK"
                });
                return;
            }
            const quantity = document.getElementById("quantityInput").value;
            Swal.fire({
                title: "Redirect ke Checkout",
                text: Warna: $ {
                    selectedColorValue
                },
                Ukuran: $ {
                    selectedSizeValue
                },
                Jumlah: $ {
                    quantity
                },
                icon: "success",
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                window.location.href = "/checkout";
            });
        }

        function addToCart() {
            Swal.fire({
                title: "Item berhasil ditambahkan ke keranjang!",
                icon: "success",
                timer: 1200,
                showConfirmButton: false
            });
            toggleBuyNowModal(false);
        }
    </script>
    </body>

    </html>
</x-layout>
