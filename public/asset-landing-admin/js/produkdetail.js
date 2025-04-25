// ===============================================
            // Konstanta & Variabel
            // ===============================================
            const purchased = true; // Ubah ke false jika user belum membeli
            const itemCode = "SBALITA-001"; // Code produk
            const STORAGE_KEY = `reviewsData_${itemCode}`;
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
                    title.innerHTML =
                        `${rv.name} <span class="text-yellow-500">${"★".repeat(rv.rating)}${"☆".repeat(5 - rv.rating)}</span>`;
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
                        html: `<textarea id="swal-input" class="swal2-textarea" placeholder="Ubah review Anda di sini...">${review.text}</textarea>`,
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
                document.getElementById("selectedColor").innerHTML =
                    `Warna yang dipilih: <span class="font-bold">${colorName}</span>`;
            }

            function selectSize(e, size) {
                e.preventDefault();
                selectedSizeValue = size;
                document.querySelectorAll("#sizeOptions button").forEach(btn => btn.classList.remove("bg-gray-200", "ring-2",
                    "ring-black"));
                e.target.classList.add("bg-gray-200", "ring-2", "ring-black");
                document.getElementById("selectedSize").innerHTML =
                    `Ukuran yang dipilih: <span class="font-bold">${size}</span>`;
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
                    text: `Warna: ${selectedColorValue}, Ukuran: ${selectedSizeValue}, Jumlah: ${quantity}`,
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