document.addEventListener('DOMContentLoaded', () => {
    const productForm = document.getElementById('productForm');

    if (!productForm) return;

    const submitBtn = productForm.querySelector('button[type="submit"]');

    const namaInput = document.getElementById('nama');
    const kategoriInput = document.getElementById('kategori_id');
    const deskripsiInput = document.getElementById('deskripsi');
    const hargaInput = document.getElementById('harga');
    const stokInput = document.getElementById('stok');
    const statusInput = document.getElementById('is_active');

    // Input berat produk
    const beratInput = document.getElementById('berat_input');
    const beratSatuanInput = document.getElementById('berat_satuan');
    const beratGramInput = document.getElementById('berat');
    const beratError = document.getElementById('berat-error');
    const beratKonversi = document.getElementById('berat-konversi');

    const thumbnailInput = document.getElementById('thumbnail');
    const thumbnailPreview = document.getElementById('thumbnailPreview');
    const thumbnailPlaceholder = document.getElementById('thumbnailPlaceholder');
    const thumbnailError = document.getElementById('thumbnailError');

    const previewPhotosInput = document.getElementById('preview_photos');
    const previewUploadArea = document.getElementById('previewUploadArea');
    const previewGallery = document.getElementById('previewGallery');
    const previewPhotoCount = document.getElementById('previewPhotoCount');
    const previewPhotosError = document.getElementById('previewPhotosError');

    const mainProductPreview = document.getElementById('mainProductPreview');
    const previewPlaceholder = document.getElementById('previewPlaceholder');

    const previewName = document.getElementById('previewName');
    const previewCategory = document.getElementById('previewCategory');
    const previewDescription = document.getElementById('previewDescription');
    const previewPrice = document.getElementById('previewPrice');

    const nameCounter = document.getElementById('nameCounter');
    const descriptionCounter = document.getElementById('descriptionCounter');

    const maxPreviewPhotos = 4;
    const maxFileSize = 2 * 1024 * 1024;
    const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

    let selectedPreviewFiles = [];
    let thumbnailObjectUrl = null;
    let previewObjectUrls = [];

    // ========================================
    // BERAT PRODUK: KONVERSI KE GRAM
    // ========================================

    function getBeratDalamGram() {
        if (!beratInput || !beratSatuanInput) {
            return null;
        }

        const value = beratInput.value.trim();

        if (value === '') {
            return null;
        }

        const numericValue = Number(value);

        if (!Number.isFinite(numericValue) || numericValue <= 0) {
            return null;
        }

        if (beratSatuanInput.value === 'gram') {
            if (!Number.isInteger(numericValue)) {
                return null;
            }

            if (!Number.isSafeInteger(numericValue)) {
                return null;
            }

            return numericValue;
        }

        if (beratSatuanInput.value === 'kg') {
            const decimalPart = value.split('.')[1] || '';

            // Maksimal 3 angka di belakang koma.
            if (decimalPart.length > 3) {
                return null;
            }

            const grams = numericValue * 1000;
            const roundedGrams = Math.round(grams);

            // Pastikan hasil konversi tepat dalam gram.
            if (Math.abs(grams - roundedGrams) > 0.000001) {
                return null;
            }

            if (!Number.isSafeInteger(roundedGrams)) {
                return null;
            }

            return roundedGrams;
        }

        return null;
    }

    function updateBerat() {
        if (!beratInput || !beratSatuanInput || !beratGramInput) {
            return;
        }

        const isKg = beratSatuanInput.value === 'kg';

        // Sesuaikan ketelitian input dengan satuan.
        beratInput.step = isKg ? '0.001' : '1';
        beratInput.min = isKg ? '0.001' : '1';

        const grams = getBeratDalamGram();

        if (grams === null) {
            beratGramInput.value = '';

            if (beratKonversi) {
                beratKonversi.textContent = '—';
            }

            return;
        }

        // Nilai yang dikirim ke Laravel selalu dalam gram.
        beratGramInput.value = String(grams);

        if (beratKonversi) {
            beratKonversi.textContent =
                new Intl.NumberFormat('id-ID').format(grams) + ' gram';
        }
    }

    // ========================================
    // KONFIGURASI VALIDASI INPUT
    // ========================================

    const inputForm = {
        nama: {
            input: namaInput,
            borderField: namaInput,
            error: document.getElementById('nama-error'),

            validate: value => {
                if (!value) {
                    return 'Nama produk tidak boleh kosong!';
                }

                if (value.length < 3) {
                    return 'Nama produk minimal 3 karakter!';
                }

                if (value.length > 150) {
                    return 'Nama produk maksimal 150 karakter!';
                }

                return '';
            }
        },

        kategori_id: {
            input: kategoriInput,
            borderField: kategoriInput,
            error: document.getElementById('kategori-error'),

            validate: value => {
                if (!value) {
                    return 'Kategori produk wajib dipilih!';
                }

                return '';
            }
        },

        deskripsi: {
            input: deskripsiInput,
            borderField: deskripsiInput,
            error: document.getElementById('deskripsi-error'),

            validate: value => {
                if (!value) {
                    return 'Deskripsi produk tidak boleh kosong!';
                }

                if (value.length < 10) {
                    return 'Deskripsi minimal 10 karakter!';
                }

                if (value.length > 1000) {
                    return 'Deskripsi maksimal 1.000 karakter!';
                }

                return '';
            }
        },

        harga: {
            input: hargaInput,
            borderField: hargaInput,
            error: document.getElementById('harga-error'),

            validate: value => {
                if (value === '') {
                    return 'Harga produk tidak boleh kosong!';
                }

                const harga = Number(value);

                if (!Number.isFinite(harga) || harga < 1) {
                    return 'Harga produk minimal Rp1!';
                }

                if (!Number.isInteger(harga)) {
                    return 'Harga harus berupa bilangan bulat!';
                }

                return '';
            }
        },

        stok: {
            input: stokInput,
            borderField: stokInput,
            error: document.getElementById('stok-error'),

            validate: value => {
                if (value === '') {
                    return 'Stok produk tidak boleh kosong!';
                }

                const stok = Number(value);

                if (!Number.isSafeInteger(stok) || stok < 0) {
                    return 'Stok harus berupa bilangan bulat dan tidak negatif!';
                }

                return '';
            }
        },

        // Berat menggunakan input satuan gram/kg,
        // tetapi nilai yang dikirim adalah gram.
        berat: {
            input: beratInput,
            borderField: beratInput,
            error: beratError,

            validate: value => {
                if (value === '') {
                    return 'Berat produk wajib diisi!';
                }

                const grams = getBeratDalamGram();

                if (grams === null || grams < 1) {
                    return beratSatuanInput &&
                        beratSatuanInput.value === 'kg'
                        ? 'Berat harus minimal 0.001 kg dan maksimal 3 angka desimal!'
                        : 'Berat harus berupa bilangan bulat minimal 1 gram!';
                }

                if (!Number.isSafeInteger(grams)) {
                    return 'Berat produk terlalu besar!';
                }

                return '';
            }
        },

        is_active: {
            input: statusInput,
            borderField: statusInput,
            error: document.getElementById('status-error'),

            validate: value => {
                if (!['0', '1'].includes(value)) {
                    return 'Silakan pilih status produk!';
                }

                return '';
            }
        }
    };

    // ========================================
    // VALIDASI SATU FIELD
    // ========================================

    function validateField(field) {
        if (!field.input || !field.error || !field.borderField) {
            return true;
        }

        const value = field.input.value.trim();
        const message = field.validate(value);

        field.borderField.classList.remove(
            'border-red-400',
            'border-green-400'
        );

        if (message) {
            field.borderField.classList.add('border-red-400');

            field.error.textContent = message;
            field.error.classList.remove('hidden');

            return false;
        }

        field.borderField.classList.add('border-green-400');

        field.error.textContent = '';
        field.error.classList.add('hidden');

        return true;
    }

    // ========================================
    // VALIDASI GAMBAR
    // ========================================

    function isValidImage(file) {
        return Boolean(
            file &&
            allowedTypes.includes(file.type) &&
            file.size <= maxFileSize
        );
    }

    function validateThumbnail() {
        const file = thumbnailInput.files[0];
        let message = '';

        if (!file) {
            message = 'Foto thumbnail wajib dipilih!';
        } else if (!isValidImage(file)) {
            message = 'Gunakan JPG, JPEG, PNG, atau WEBP maksimal 2 MB!';
        }

        if (message) {
            thumbnailError.textContent = message;
            thumbnailError.classList.remove('hidden');

            return false;
        }

        thumbnailError.textContent = '';
        thumbnailError.classList.add('hidden');

        return true;
    }

    function validatePreviewPhotos() {
        let message = '';

        if (selectedPreviewFiles.length === 0) {
            message = 'Foto preview wajib diisi minimal 1 foto!';
        } else if (selectedPreviewFiles.length > maxPreviewPhotos) {
            message = 'Foto preview maksimal 4 file!';
        } else if (!selectedPreviewFiles.every(isValidImage)) {
            message = 'Terdapat foto preview yang tidak valid!';
        }

        if (message) {
            previewPhotosError.textContent = message;
            previewPhotosError.classList.remove('hidden');

            return false;
        }

        previewPhotosError.textContent = '';
        previewPhotosError.classList.add('hidden');

        return true;
    }

    // ========================================
    // VALIDASI SELURUH FORM
    // ========================================

    function validateForm() {
        // Pastikan hidden input berat selalu diperbarui.
        updateBerat();

        let valid = true;

        Object.values(inputForm).forEach(field => {
            if (!validateField(field)) {
                valid = false;
            }
        });

        if (!validateThumbnail()) {
            valid = false;
        }

        if (!validatePreviewPhotos()) {
            valid = false;
        }

        if (submitBtn) {
            submitBtn.disabled = !valid;

            submitBtn.classList.toggle('opacity-50', !valid);
            submitBtn.classList.toggle('cursor-not-allowed', !valid);
        }

        return valid;
    }

    // ========================================
    // EVENT VALIDASI INPUT
    // ========================================

    Object.values(inputForm).forEach(field => {
        if (!field.input) return;

        field.input.addEventListener('input', () => {
            if (field === inputForm.berat) {
                updateBerat();
            }

            validateField(field);
            validateForm();
            updateProductChecklist();
        });

        field.input.addEventListener('change', () => {
            if (field === inputForm.berat) {
                updateBerat();
            }

            validateField(field);
            validateForm();
            updateProductChecklist();
        });

        field.input.addEventListener('blur', () => {
            validateField(field);
        });
    });

    if (beratSatuanInput) {
        beratSatuanInput.addEventListener('change', () => {
            updateBerat();
            validateField(inputForm.berat);
            validateForm();
            updateProductChecklist();
        });
    }

    // ========================================
    // PREVIEW INFORMASI PRODUK
    // ========================================

    function formatRupiah(value) {
        if (value === '') return 'Rp0';

        return 'Rp' + new Intl.NumberFormat('id-ID', {
            maximumFractionDigits: 0
        }).format(Number(value) || 0);
    }

    function updateName() {
        nameCounter.textContent = namaInput.value.length + '/150';

        previewName.textContent =
            namaInput.value.trim() || 'Nama produkmu';
    }

    function updateDescription() {
        descriptionCounter.textContent =
            deskripsiInput.value.length + '/1000';

        previewDescription.textContent =
            deskripsiInput.value.trim() ||
            'Deskripsi singkat produk akan terlihat di bagian ini.';
    }

    function updateCategory() {
        const option = kategoriInput.options[kategoriInput.selectedIndex];

        previewCategory.textContent =
            kategoriInput.value ? option.text : 'Kategori produk';
    }

    namaInput.addEventListener('input', updateName);
    deskripsiInput.addEventListener('input', updateDescription);

    kategoriInput.addEventListener('change', updateCategory);

    hargaInput.addEventListener('input', () => {
        previewPrice.textContent = formatRupiah(hargaInput.value);
    });

    updateName();
    updateDescription();
    updateCategory();

    previewPrice.textContent = formatRupiah(hargaInput.value);

    // ========================================
    // PREVIEW THUMBNAIL
    // ========================================

    function resetThumbnail() {
        thumbnailPreview.src = '';
        thumbnailPreview.classList.add('hidden');

        thumbnailPlaceholder.classList.remove('hidden');

        mainProductPreview.src = '';
        mainProductPreview.classList.add('hidden');

        previewPlaceholder.classList.remove('hidden');

        if (thumbnailObjectUrl) {
            URL.revokeObjectURL(thumbnailObjectUrl);
            thumbnailObjectUrl = null;
        }
    }

    thumbnailInput.addEventListener('change', () => {
        if (!validateThumbnail()) {
            thumbnailInput.value = '';
            resetThumbnail();
            validateForm();
            updateProductChecklist();

            return;
        }

        if (thumbnailObjectUrl) {
            URL.revokeObjectURL(thumbnailObjectUrl);
        }

        thumbnailObjectUrl = URL.createObjectURL(
            thumbnailInput.files[0]
        );

        thumbnailPreview.src = thumbnailObjectUrl;
        thumbnailPreview.classList.remove('hidden');
        thumbnailPlaceholder.classList.add('hidden');

        mainProductPreview.src = thumbnailObjectUrl;
        mainProductPreview.classList.remove('hidden');
        previewPlaceholder.classList.add('hidden');

        validateForm();
        updateProductChecklist();
    });

    // ========================================
    // GALERI FOTO PREVIEW
    // ========================================

    function syncPreviewPhotosInput() {
        const dataTransfer = new DataTransfer();

        selectedPreviewFiles.forEach(file => {
            dataTransfer.items.add(file);
        });

        previewPhotosInput.files = dataTransfer.files;
    }

    function clearPreviewUrls() {
        previewObjectUrls.forEach(url => URL.revokeObjectURL(url));
        previewObjectUrls = [];
    }

    function renderPreviewGallery() {
        clearPreviewUrls();
        previewGallery.innerHTML = '';

        previewPhotoCount.textContent =
            selectedPreviewFiles.length + ' / ' + maxPreviewPhotos + ' foto';

        selectedPreviewFiles.forEach((file, index) => {
            const url = URL.createObjectURL(file);
            previewObjectUrls.push(url);

            const card = document.createElement('div');

            card.className =
                'overflow-hidden rounded-2xl border border-[#F0DFD1] bg-white';

            const image = document.createElement('img');

            image.src = url;
            image.alt = 'Foto preview ' + (index + 1);
            image.className = 'aspect-square w-full object-cover';

            const body = document.createElement('div');
            body.className = 'space-y-2 p-3';

            const label = document.createElement('p');

            label.className =
                'text-center text-[10px] font-bold text-violet-700';

            label.textContent = 'FOTO PREVIEW ' + (index + 1);

            const fileName = document.createElement('p');

            fileName.className =
                'truncate text-[11px] font-semibold text-[#72594B]';

            fileName.textContent = file.name;

            const removeButton = document.createElement('button');

            removeButton.type = 'button';

            removeButton.className =
                'w-full rounded-lg border border-red-100 px-2 py-2 ' +
                'text-[11px] font-bold text-red-600 hover:bg-red-50';

            removeButton.textContent = 'Hapus foto';

            removeButton.addEventListener('click', () => {
                selectedPreviewFiles.splice(index, 1);

                syncPreviewPhotosInput();
                renderPreviewGallery();
                validateForm();
                updateProductChecklist();
            });

            body.appendChild(label);
            body.appendChild(fileName);
            body.appendChild(removeButton);

            card.appendChild(image);
            card.appendChild(body);

            previewGallery.appendChild(card);
        });

        previewUploadArea.classList.toggle(
            'hidden',
            selectedPreviewFiles.length >= maxPreviewPhotos
        );

        updateProductChecklist();
    }

    previewPhotosInput.addEventListener('change', () => {
        const files = Array.from(previewPhotosInput.files);

        const validFiles = [];

        let invalidFile = false;
        let duplicateFile = false;

        files.forEach(file => {
            if (!isValidImage(file)) {
                invalidFile = true;
                return;
            }

            const duplicate = selectedPreviewFiles.some(selected => (
                selected.name === file.name &&
                selected.size === file.size &&
                selected.lastModified === file.lastModified
            ));

            if (duplicate) {
                duplicateFile = true;
                return;
            }

            validFiles.push(file);
        });

        const remaining = maxPreviewPhotos - selectedPreviewFiles.length;

        const acceptedFiles = validFiles.slice(
            0,
            Math.max(remaining, 0)
        );

        selectedPreviewFiles = selectedPreviewFiles.concat(acceptedFiles);

        if (invalidFile) {
            previewPhotosError.textContent =
                'Gunakan JPG, JPEG, PNG, atau WEBP maksimal 2 MB per foto!';

            previewPhotosError.classList.remove('hidden');
        } else if (validFiles.length > remaining) {
            previewPhotosError.textContent =
                'Foto preview maksimal 4 file!';

            previewPhotosError.classList.remove('hidden');
        } else if (duplicateFile) {
            previewPhotosError.textContent =
                'Foto tersebut sudah ditambahkan sebelumnya.';

            previewPhotosError.classList.remove('hidden');
        } else {
            previewPhotosError.textContent = '';
            previewPhotosError.classList.add('hidden');
        }

        syncPreviewPhotosInput();
        renderPreviewGallery();

        // Reset agar file yang sama bisa dipilih kembali.
        previewPhotosInput.value = '';

        validateForm();
        updateProductChecklist();
    });

    // ========================================
    // CHECKLIST PRODUK
    // ========================================

    const checklistItems = {
        name: {
            icon: document.getElementById('check-name-icon'),
            title: document.getElementById('check-name-title'),
            desc: document.getElementById('check-name-desc'),
        },

        category: {
            icon: document.getElementById('check-category-icon'),
            title: document.getElementById('check-category-title'),
            desc: document.getElementById('check-category-desc'),
        },

        description: {
            icon: document.getElementById('check-description-icon'),
            title: document.getElementById('check-description-title'),
            desc: document.getElementById('check-description-desc'),
        },

        gallery: {
            icon: document.getElementById('check-gallery-icon'),
            title: document.getElementById('check-gallery-title'),
            desc: document.getElementById('check-gallery-desc'),
        },

        thumbnail: {
            icon: document.getElementById('check-thumbnail-icon'),
            title: document.getElementById('check-thumbnail-title'),
            desc: document.getElementById('check-thumbnail-desc'),
        },

        inventory: {
            icon: document.getElementById('check-inventory-icon'),
            title: document.getElementById('check-inventory-title'),
            desc: document.getElementById('check-inventory-desc'),
        },
    };

    const checklistProgress =
        document.getElementById('checklistProgress');

    const checklistProgressBar =
        document.getElementById('checklistProgressBar');

    const checklistComplete =
        document.getElementById('checklistComplete');

    function setChecklistItem(key, valid, description) {
        const item = checklistItems[key];

        if (!item || !item.icon || !item.title || !item.desc) {
            return;
        }

        item.icon.className =
            'checklist-icon flex h-6 w-6 shrink-0 items-center justify-center ' +
            'rounded-full transition-colors duration-200 ' +
            (valid
                ? 'bg-emerald-100 text-emerald-600'
                : 'bg-gray-100 text-gray-400');

        item.icon.innerHTML = valid
            ? '<i class="fa-solid fa-check text-xs"></i>'
            : '<i class="fa-solid fa-minus text-xs"></i>';

        item.title.classList.toggle('text-emerald-700', valid);
        item.title.classList.toggle('text-[#503626]', !valid);

        item.desc.textContent = description;
    }

    function updateProductChecklist() {
        const nama = namaInput.value.trim();
        const kategori = kategoriInput.value;
        const deskripsi = deskripsiInput.value.trim();

        const harga = Number(hargaInput.value);
        const stok = Number(stokInput.value);

        const namaValid =
            nama.length >= 3 && nama.length <= 150;

        const kategoriValid =
            kategori !== '';

        const deskripsiValid =
            deskripsi.length >= 10 && deskripsi.length <= 1000;

        const galleryValid =
            selectedPreviewFiles.length >= 1 &&
            selectedPreviewFiles.length <= maxPreviewPhotos &&
            selectedPreviewFiles.every(isValidImage);

        const thumbnailValid =
            thumbnailInput.files.length > 0 &&
            isValidImage(thumbnailInput.files[0]);

        const beratGram = getBeratDalamGram();

        const hargaValid =
            hargaInput.value.trim() !== '' &&
            Number.isFinite(harga) &&
            Number.isInteger(harga) &&
            harga >= 1;

        const stokValid =
            stokInput.value.trim() !== '' &&
            Number.isSafeInteger(stok) &&
            stok >= 0;

        const beratValid =
            beratGram !== null &&
            Number.isSafeInteger(beratGram) &&
            beratGram >= 1;

        const inventoryValid =
            hargaValid &&
            stokValid &&
            beratValid;

        setChecklistItem(
            'name',
            namaValid,
            namaValid
                ? 'Nama produk sudah sesuai.'
                : 'Nama produk harus terdiri dari 3–150 karakter.'
        );

        setChecklistItem(
            'category',
            kategoriValid,
            kategoriValid
                ? 'Kategori produk sudah dipilih.'
                : 'Pilih kategori produk terlebih dahulu.'
        );

        setChecklistItem(
            'description',
            deskripsiValid,
            deskripsiValid
                ? 'Deskripsi produk sudah sesuai.'
                : 'Deskripsi harus terdiri dari 10–1.000 karakter.'
        );

        setChecklistItem(
            'gallery',
            galleryValid,
            galleryValid
                ? selectedPreviewFiles.length + ' foto preview sudah dipilih.'
                : 'Unggah minimal 1 dan maksimal 4 foto yang valid.'
        );

        setChecklistItem(
            'thumbnail',
            thumbnailValid,
            thumbnailValid
                ? 'Thumbnail utama sudah dipilih.'
                : 'Pilih thumbnail JPG, PNG, atau WEBP maksimal 2 MB.'
        );

        let inventoryDescription;

        if (inventoryValid) {
            inventoryDescription =
                'Harga, stok, dan berat produk sudah valid.';
        } else if (!hargaValid) {
            inventoryDescription =
                'Periksa harga produk. Minimal Rp1 dan harus bilangan bulat.';
        } else if (!stokValid) {
            inventoryDescription =
                'Periksa stok produk. Stok harus bilangan bulat minimal 0.';
        } else {
            inventoryDescription =
                'Periksa berat produk. Minimal 1 gram atau 0.001 kg.';
        }

        setChecklistItem(
            'inventory',
            inventoryValid,
            inventoryDescription
        );

        const total = 6;

        const completed = [
            namaValid,
            kategoriValid,
            deskripsiValid,
            galleryValid,
            thumbnailValid,
            inventoryValid,
        ].filter(Boolean).length;

        if (checklistProgress) {
            checklistProgress.textContent = completed + '/' + total;
        }

        if (checklistProgressBar) {
            checklistProgressBar.style.width =
                (completed / total * 100) + '%';
        }

        if (checklistComplete) {
            checklistComplete.classList.toggle(
                'hidden',
                completed !== total
            );
        }
    }

    // ========================================
    // SUBMIT FORM
    // ========================================

    productForm.addEventListener('submit', event => {
        updateBerat();

        if (!validateForm()) {
            event.preventDefault();

            const firstInvalid = productForm.querySelector(
                '.border-red-400'
            );

            if (firstInvalid) {
                firstInvalid.focus();

                firstInvalid.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }

            updateProductChecklist();
            return;
        }

        syncPreviewPhotosInput();
    });

    // ========================================
    // INISIALISASI
    // ========================================

    updateBerat();

    validateForm();
    updateProductChecklist();

    // ========================================
    // BERSIHKAN OBJECT URL
    // ========================================

    window.addEventListener('beforeunload', () => {
        if (thumbnailObjectUrl) {
            URL.revokeObjectURL(thumbnailObjectUrl);
        }

        clearPreviewUrls();
    });
});
