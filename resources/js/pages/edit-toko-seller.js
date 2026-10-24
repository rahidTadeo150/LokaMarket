document.addEventListener('DOMContentLoaded', function () {
    const profileForm = document.getElementById('form-edit-profil');
    const submitBtn = document.getElementById('submitBtn');

    if (!profileForm || !submitBtn) {
        return;
    }

    const fotoInput = document.getElementById('foto_profil');
    const previewFoto = document.getElementById('previewFotoToko');
    const placeholderFoto = document.getElementById('placeholderFotoToko');
    const previewSidebar = document.getElementById('previewFotoSidebar');
    const iconSidebar = document.getElementById('iconFotoSidebar');
    const namaFileFoto = document.getElementById('namaFileFoto');

    const namaInput = document.getElementById('nama_toko');
    const deskripsiInput = document.getElementById('deskripsi');
    const alamatInput = document.getElementById('alamat');
    const teleponInput = document.getElementById('no_telepon');

    const inputProvinsi = document.getElementById('provinsi_id');
    const inputKota = document.getElementById('kota_id');
    const inputKecamatan = document.getElementById('kecamatan_id');

    const jumlahDeskripsi = document.getElementById('jumlahDeskripsi');

    // Preview data toko
    const previewNama = document.getElementById('previewNamaToko');
    const previewSlug = document.getElementById('previewSlugToko');
    const previewDeskripsi = document.getElementById('previewDeskripsiToko');
    const previewAlamat = document.getElementById('previewAlamatToko');
    const previewTelepon = document.getElementById('previewTeleponToko');

    // Kontrol nomor telepon
    const btnGantiTelepon = document.getElementById('btnGantiTelepon');
    const btnBatalTelepon = document.getElementById('btnBatalGantiTelepon');
    const btnSimpanTelepon = document.getElementById('btnSimpanTelepon');
    const formGantiTelepon = document.getElementById('formGantiTelepon');
    const teleponSaatIni = document.getElementById('teleponSaatIni');
    const teksTeleponSaatIni = document.getElementById('teksTeleponSaatIni');

    const nomorTeleponAwal = teleponInput?.value ?? '';

    function showError(field, message) {
        if (!field.input || !field.borderField) return;

        field.borderField.classList.remove('border-green-400');
        field.borderField.classList.add('border-red-400');

        if (field.error) {
            field.error.textContent = message;
            field.error.classList.remove('hidden');
        }
    }

    function clearError(field) {
        if (!field.input || !field.borderField) return;

        field.borderField.classList.remove('border-red-400');
        field.borderField.classList.remove('border-green-400');

        if (field.error) {
            field.error.textContent = '';
            field.error.classList.add('hidden');
        }
    }

    const fotoField = {
        input: fotoInput,
        borderField: fotoInput,
        error: document.getElementById('foto-profil-error'),

        validate: function () {
            const file = fotoInput?.files?.[0];

            // Foto baru tidak wajib dipilih.
            if (!file) return '';

            if (!['image/jpeg', 'image/png'].includes(file.type)) {
                return 'Foto harus berformat JPG, JPEG, atau PNG.';
            }

            if (file.size > 2 * 1024 * 1024) {
                return 'Ukuran foto maksimal 2 MB.';
            }

            return '';
        }
    };

    const inputForm = {
        nama_toko: {
            input: namaInput,
            borderField: namaInput,
            error: document.getElementById('nama-toko-error'),

            validate: function (value) {
                if (!value) return 'Nama toko wajib diisi.';
                if (value.length < 3) return 'Nama toko minimal 3 karakter.';
                if (value.length > 100) return 'Nama toko maksimal 100 karakter.';
                return '';
            }
        },

        deskripsi: {
            input: deskripsiInput,
            borderField: deskripsiInput,
            error: document.getElementById('deskripsi-error'),

            validate: function (value) {
                if (!value) return 'Deskripsi toko wajib diisi.';
                if (value.length < 10) return 'Deskripsi toko minimal 10 karakter.';
                if (value.length > 500) return 'Deskripsi toko maksimal 500 karakter.';
                return '';
            }
        },

        no_telepon: {
            input: teleponInput,
            borderField: teleponInput,
            error: document.getElementById('no-telepon-error'),

            validate: function (value) {
                if (!value) return 'Nomor telepon wajib diisi.';
                if (value.length < 10) return 'Nomor telepon minimal 10 karakter.';
                if (value.length > 15) return 'Nomor telepon maksimal 15 karakter.';
                return '';
            }
        },

        provinsi: {
            input: provinsi,
            borderField: inputProvinsi,
            error: document.getElementById('provinsi-error'),

            validate: function (value) {
                return value ? '' : 'Provinsi wajib dipilih.';
            }
        },

        kota: {
            input: kota,
            borderField: inputKota,
            error: document.getElementById('kota-error'),

            validate: function (value) {
                return value ? '' : 'Kota atau kabupaten wajib dipilih.';
            }
        },

        kecamatan: {
            input: kecamatan,
            borderField: inputKecamatan,
            error: document.getElementById('kecamatan-error'),

            validate: function (value) {
                return value ? '' : 'Kecamatan wajib dipilih.';
            }
        },

        alamat: {
            input: alamatInput,
            borderField: alamatInput,
            error: document.getElementById('alamat-error'),

            validate: function (value) {
                if (!value) return 'Alamat lengkap wajib diisi.';
                if (value.length < 10) return 'Alamat lengkap minimal 10 karakter.';
                if (value.length > 500) return 'Alamat lengkap maksimal 500 karakter.';
                return '';
            }
        },

        foto_profil: fotoField
    };

function validateField(field) {

    if (!field.input) {
        console.warn('Input tidak ditemukan:', field);
        return false;
    }

    if (field === fotoField && !field.input.files?.length) {
        clearError(field);
        return true;
    }

    const value = field.input.type === 'file'
        ? field.input.files[0]
        : field.input.value.trim();

    const message = field.validate(value);

    if (message) {
        showError(field, message);
        return false;
    }

    clearError(field);
    return true;
}

function validateForm() {
    const requiredFields = [
        inputForm.nama_toko,
        inputForm.deskripsi,
        inputForm.no_telepon,
        inputForm.provinsi,
        inputForm.kota,
        inputForm.kecamatan,
        inputForm.alamat
    ];

    const results = requiredFields.map(function (field) {
        return {
            name: field.input?.id || 'Input tidak ditemukan',
            valid: validateField(field)
        };
    });

    const fotoValid = validateField(fotoField);

    const valid = results.every(item => item.valid) && fotoValid;

    submitBtn.disabled = !valid;
    submitBtn.classList.toggle('opacity-50', !valid);
    submitBtn.classList.toggle('cursor-not-allowed', !valid);

    console.table(results);

    return valid;
}

    // ========================================
    // EVENT VALIDASI INPUT
    // ========================================
    Object.values(inputForm).forEach(function (field) {
        if (!field.input) return;

        ['input', 'change', 'blur'].forEach(function (eventName) {
            field.input.addEventListener(eventName, function () {
                validateField(field);
                validateForm();
            });
        });
    });

    // ========================================
    // PREVIEW FOTO TOKO
    // ========================================
    if (fotoInput) {
        fotoInput.addEventListener('change', function () {
            const file = this.files?.[0];

            if (!file) {
                validateForm();
                return;
            }

            const message = fotoField.validate();

            if (message) {
                showError(fotoField, message);
                alert(message);
                this.value = '';
                validateForm();
                return;
            }

            clearError(fotoField);

            const reader = new FileReader();

            reader.onload = function (event) {
                const imageUrl = event.target.result;

                if (previewFoto) {
                    previewFoto.src = imageUrl;
                    previewFoto.classList.remove('hidden');
                }

                if (placeholderFoto) {
                    placeholderFoto.classList.add('hidden');
                }

                if (previewSidebar) {
                    previewSidebar.src = imageUrl;
                    previewSidebar.classList.remove('hidden');
                }

                if (iconSidebar) {
                    iconSidebar.classList.add('hidden');
                }

                if (namaFileFoto) {
                    namaFileFoto.textContent = file.name;
                }
            };

            reader.readAsDataURL(file);
            validateForm();
        });
    }

    // ========================================
    // PREVIEW NAMA TOKO DAN SLUG
    // ========================================
    function updatePreviewNama() {
        if (previewNama && namaInput) {
            previewNama.textContent = namaInput.value.trim() || 'Nama Toko Anda';
        }

        if (previewSlug && namaInput) {
            const slug = namaInput.value
                .trim()
                .toLowerCase()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');

            previewSlug.textContent = '/toko/' + (slug || 'url-toko');
        }
    }

    if (namaInput) {
        namaInput.addEventListener('input', updatePreviewNama);
        updatePreviewNama();
    }

    // ========================================
    // PREVIEW DESKRIPSI DAN JUMLAH KARAKTER
    // ========================================
    function updatePreviewDeskripsi() {
        if (previewDeskripsi && deskripsiInput) {
            previewDeskripsi.textContent =
                deskripsiInput.value.trim() ||
                'Deskripsi toko akan ditampilkan di sini.';
        }

        if (jumlahDeskripsi && deskripsiInput) {
            jumlahDeskripsi.textContent = deskripsiInput.value.length + '/500';
        }
    }

    if (deskripsiInput) {
        deskripsiInput.addEventListener('input', updatePreviewDeskripsi);
        updatePreviewDeskripsi();
    }

    // ========================================
    // PREVIEW ALAMAT
    // ========================================
    function updatePreviewAlamat() {
        if (!previewAlamat || !alamatInput) return;

        previewAlamat.textContent =
            alamatInput.value.trim() || 'Alamat toko belum diisi';
    }

    if (alamatInput) {
        alamatInput.addEventListener('input', updatePreviewAlamat);
        updatePreviewAlamat();
    }

    // ========================================
    // GANTI NOMOR TELEPON
    // ========================================
    function bukaFormTelepon() {
        formGantiTelepon?.classList.remove('hidden');
        teleponSaatIni?.classList.add('hidden');
        btnGantiTelepon?.classList.add('hidden');
        teleponInput?.focus();
    }

    function tutupFormTelepon() {
        formGantiTelepon?.classList.add('hidden');
        teleponSaatIni?.classList.remove('hidden');
        btnGantiTelepon?.classList.remove('hidden');
    }

    if (btnGantiTelepon) {
        btnGantiTelepon.addEventListener('click', function () {
            bukaFormTelepon();
        });
    }

    if (btnBatalTelepon) {
        btnBatalTelepon.addEventListener('click', function () {
            // Kembalikan nomor ke nilai awal saat halaman dibuka.
            if (teleponInput) {
                teleponInput.value = nomorTeleponAwal;
                validateField(inputForm.no_telepon);
                validateForm();
            }

            tutupFormTelepon();
        });
    }

    if (btnSimpanTelepon) {
        btnSimpanTelepon.addEventListener('click', function () {
            const field = inputForm.no_telepon;

            if (!validateField(field)) {
                teleponInput?.focus();
                validateForm();
                return;
            }

            const nomor = teleponInput.value.trim();

            if (previewTelepon) {
                previewTelepon.textContent = nomor;
            }

            if (teksTeleponSaatIni) {
                teksTeleponSaatIni.textContent = nomor;
            }

            tutupFormTelepon();
            validateForm();
        });
    }

    // ========================================
    // SUBMIT FORM
    // ========================================
    profileForm.addEventListener('submit', function (event) {
        if (!validateForm()) {
            event.preventDefault();

            const firstInvalid = Object.values(inputForm).find(function (field) {
                if (!field.input || !field.borderField) return false;

                return field.borderField.classList.contains('border-red-400');
            });

            if (firstInvalid) {
                firstInvalid.input.focus();
            }
        }
    });

    // ========================================
    // VALIDASI AWAL
    // ========================================
    updatePreviewNama();
    updatePreviewDeskripsi();
    updatePreviewAlamat();
    validateForm();

});