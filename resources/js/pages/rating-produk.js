document.addEventListener("DOMContentLoaded", function () {
    const reviewForm = document.getElementById("reviewForm");

    if (!reviewForm) return;

    const submitBtn = document.getElementById("submitReviewButton");

    const MAX_FOTO = 5;
    const MAX_SIZE = 5 * 1024 * 1024;
    const MAX_ULASAN = 1000;

    const FORMAT_FOTO = ["image/jpeg", "image/png", "image/webp"];

    const ratingData = {
        1: ["Sangat Buruk", "Produk sangat tidak sesuai harapan."],
        2: ["Kurang Memuaskan", "Masih banyak hal yang perlu diperbaiki."],
        3: ["Cukup Baik", "Produk cukup sesuai dengan harapan."],
        4: ["Memuaskan", "Produk sesuai dengan yang diharapkan."],
        5: ["Sangat Memuaskan!", "Pengalaman yang luar biasa!"],
    };

    const reviewCards = document.querySelectorAll("[data-review-card]");

    const cardValidators = [];

    // ==========================================
    // HELPER VALIDASI
    // ==========================================

    function setBorder(element, valid) {
        if (!element) return;

        element.classList.remove("border-red-400", "border-green-400");

        element.classList.add(valid ? "border-green-400" : "border-red-400");
    }

    function showError(element, message) {
        if (!element) return;

        element.textContent = message;
        element.classList.remove("hidden");
    }

    function hideError(element) {
        if (!element) return;

        element.textContent = "";
        element.classList.add("hidden");
    }

    // ==========================================
    // SETIAP CARD PRODUK
    // ==========================================

    reviewCards.forEach((card) => {
        const ratingInput = card.querySelector(".rating-value");
        const starContainer = card.querySelector("[data-rating-stars]");
        const stars = card.querySelectorAll(".rating-star");

        const ratingLabel = card.querySelector(".rating-label");
        const ratingDescription = card.querySelector(".rating-description");
        const ratingError = card.querySelector(".rating-validation-error");

        const textarea = card.querySelector(".review-textarea");
        const charCount = card.querySelector(".char-count");
        const reviewError = card.querySelector(".review-validation-error");

        const photoInput = card.querySelector(".review-photo-input");
        const uploadButton = card.querySelector(".upload-photo");
        const previewContainer = card.querySelector(".photo-preview");
        const photoError = card.querySelector(".photo-validation-error");

        // Produk yang sudah dinilai tidak perlu divalidasi.
        if (!ratingInput || !textarea) return;

        let selectedFiles = [];
        let photoSelectionError = "";

        const objectUrls = new Map();

        // ======================================
        // UPDATE RATING
        // ======================================

        function updateRating(value) {
            stars.forEach((star) => {
                const active = Number(star.dataset.rating) <= value;

                star.classList.toggle("text-[#FFB21C]", active);
                star.classList.toggle("text-[#E8DCCF]", !active);

                star.classList.toggle("bg-orange-50", active);
                star.classList.toggle("bg-[#FFF9F2]", !active);
            });

            if (value > 0 && ratingData[value]) {
                ratingLabel.textContent = ratingData[value][0];

                ratingDescription.textContent = ratingData[value][1];
            } else {
                ratingLabel.textContent = "Pilih rating produk";

                ratingDescription.textContent =
                    "Ketuk salah satu bintang untuk memberikan penilaian.";
            }
        }

        // ======================================
        // VALIDASI RATING
        // ======================================

        function validateRating() {
            const value = Number(ratingInput.value);

            if (!value || value < 1 || value > 5) {
                setBorder(starContainer, false);

                showError(
                    ratingError,
                    "Silakan pilih rating untuk produk ini!",
                );

                return false;
            }

            setBorder(starContainer, true);
            hideError(ratingError);

            return true;
        }

        // ======================================
        // VALIDASI ULASAN
        // ======================================

        function validateUlasan() {
            const value = textarea.value.trim();

            if (!value) {
                setBorder(textarea, false);

                showError(reviewError, "Ulasan tidak boleh kosong!");

                return false;
            }

            if (value.length < 10) {
                setBorder(textarea, false);

                showError(reviewError, "Ulasan minimal 10 karakter!");

                return false;
            }

            if (value.length > MAX_ULASAN) {
                setBorder(textarea, false);

                showError(reviewError, "Ulasan maksimal 1.000 karakter!");

                return false;
            }

            setBorder(textarea, true);
            hideError(reviewError);

            return true;
        }

        // ======================================
        // VALIDASI FOTO
        // ======================================

        function validateFoto() {
            if (!photoInput) return true;

            if (photoSelectionError) {
                showError(photoError, photoSelectionError);

                return false;
            }

            if (selectedFiles.length > MAX_FOTO) {
                showError(photoError, "Maksimal 5 foto untuk setiap produk!");

                return false;
            }

            for (const file of selectedFiles) {
                if (!FORMAT_FOTO.includes(file.type)) {
                    showError(
                        photoError,
                        "Gunakan format JPG, PNG, atau WEBP!",
                    );

                    return false;
                }

                if (file.size > MAX_SIZE) {
                    showError(
                        photoError,
                        `Ukuran foto "${file.name}" maksimal 5 MB!`,
                    );

                    return false;
                }
            }

            hideError(photoError);

            return true;
        }

        // ======================================
        // VALIDASI CARD
        // ======================================

        function validateCard() {
            const ratingValid = validateRating();
            const ulasanValid = validateUlasan();
            const fotoValid = validateFoto();

            return ratingValid && ulasanValid && fotoValid;
        }

        cardValidators.push({
            card,
            validateCard,
            validateRating,
            validateUlasan,
            validateFoto,
        });

        // ======================================
        // EVENT BINTANG
        // ======================================

        stars.forEach((star) => {
            star.addEventListener("click", function () {
                ratingInput.value = this.dataset.rating;

                updateRating(Number(ratingInput.value));

                validateRating();
                validateForm();
            });

            star.addEventListener("mouseenter", function () {
                const value = Number(this.dataset.rating);

                stars.forEach((item) => {
                    const active = Number(item.dataset.rating) <= value;

                    item.classList.toggle("text-[#FFB21C]", active);
                    item.classList.toggle("text-[#E8DCCF]", !active);
                });
            });
        });

        starContainer.addEventListener("mouseleave", function () {
            updateRating(Number(ratingInput.value));
        });

        updateRating(Number(ratingInput.value));

        // ======================================
        // EVENT TEXTAREA
        // ======================================

        function updateCount() {
            charCount.textContent = textarea.value.length;
        }

        updateCount();

        textarea.addEventListener("input", function () {
            updateCount();

            validateUlasan();
            validateForm();
        });

        textarea.addEventListener("blur", function () {
            validateUlasan();
            validateForm();
        });

        // ======================================
        // UPLOAD FOTO
        // ======================================

        if (photoInput && uploadButton && previewContainer) {
            uploadButton.addEventListener("click", function () {
                photoInput.click();
            });

            photoInput.addEventListener("change", function () {
                const newFiles = Array.from(this.files);

                photoSelectionError = "";

                for (const file of newFiles) {
                    if (selectedFiles.length >= MAX_FOTO) {
                        photoSelectionError =
                            "Maksimal 5 foto untuk setiap produk.";

                        break;
                    }

                    if (!FORMAT_FOTO.includes(file.type)) {
                        photoSelectionError =
                            "Gunakan format JPG, PNG, atau WEBP.";

                        continue;
                    }

                    if (file.size > MAX_SIZE) {
                        photoSelectionError = `Ukuran foto "${file.name}" maksimal 5 MB.`;

                        continue;
                    }

                    selectedFiles.push(file);
                }

                renderPhotos();

                validateFoto();
                validateForm();
            });

            // ==================================
            // RENDER PREVIEW
            // ==================================

            function renderPhotos() {
                previewContainer.innerHTML = "";

                selectedFiles.forEach((file, index) => {
                    const wrapper = document.createElement("div");

                    wrapper.className =
                        "relative aspect-square overflow-hidden rounded-2xl border border-[#F1DCC8]";

                    const image = document.createElement("img");

                    if (!objectUrls.has(file)) {
                        objectUrls.set(file, URL.createObjectURL(file));
                    }

                    image.src = objectUrls.get(file);

                    image.className = "h-full w-full object-cover";

                    const remove = document.createElement("button");

                    remove.type = "button";

                    remove.className =
                        "absolute right-2 top-2 flex h-7 w-7 items-center justify-center rounded-full bg-black/60 text-xs text-white transition hover:bg-red-500";

                    remove.innerHTML = '<i class="fa-solid fa-xmark"></i>';

                    remove.addEventListener("click", function () {
                        URL.revokeObjectURL(objectUrls.get(file));

                        objectUrls.delete(file);

                        selectedFiles.splice(index, 1);

                        photoSelectionError = "";

                        renderPhotos();

                        validateFoto();
                        validateForm();
                    });

                    wrapper.append(image, remove);

                    previewContainer.appendChild(wrapper);
                });

                // Tombol tambah foto

                if (selectedFiles.length < MAX_FOTO) {
                    previewContainer.appendChild(uploadButton);
                }

                // Sinkronisasi input file

                const transfer = new DataTransfer();

                selectedFiles.forEach((file) => {
                    transfer.items.add(file);
                });

                photoInput.files = transfer.files;
            }
        }
    });

    // ==========================================
    // VALIDASI SELURUH FORM
    // ==========================================

    function validateForm() {
        let valid = cardValidators.length > 0;

        cardValidators.forEach((item) => {
            if (!item.validateCard()) {
                valid = false;
            }
        });

        if (submitBtn) {
            submitBtn.disabled = !valid;

            submitBtn.classList.toggle("opacity-50", !valid);

            submitBtn.classList.toggle("cursor-not-allowed", !valid);
        }

        return valid;
    }

    // ==========================================
    // SUBMIT FORM
    // ==========================================

    reviewForm.addEventListener("submit", function (event) {
        if (!validateForm()) {
            event.preventDefault();

            const firstInvalid = cardValidators.find((item) => {
                return !item.validateCard();
            });

            if (firstInvalid) {
                firstInvalid.card.scrollIntoView({
                    behavior: "smooth",
                    block: "center",
                });

                const rating = firstInvalid.card.querySelector(".rating-value");

                const textarea =
                    firstInvalid.card.querySelector(".review-textarea");

                if (Number(rating.value) < 1) {
                    firstInvalid.card
                        .querySelector("[data-rating-stars] button")
                        ?.focus();
                } else if (textarea.value.trim().length < 10) {
                    textarea.focus();
                }
            }

            return;
        }

        if (submitBtn) {
            submitBtn.disabled = true;

            submitBtn.innerHTML = `
                <i class="fa-solid fa-spinner fa-spin"></i>
                Mengirim Penilaian...
            `;
        }
    });

    validateForm();
});
