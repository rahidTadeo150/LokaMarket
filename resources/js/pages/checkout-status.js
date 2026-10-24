
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('returnModal');

    if (!modal) {
        console.error('Modal return tidak ditemukan: #returnModal');
        return;
    }

    const openButtons = document.querySelectorAll('[data-return-modal-open]');
    const closeButton = document.getElementById('closeReturnModal');
    const cancelButton = document.getElementById('cancelReturnModal');
    const form = document.getElementById('returnOrderForm');
    const inputFoto = document.getElementById('foto_return');
    const namaFoto = document.getElementById('namaFotoReturn');
    const previewContainer = document.getElementById('previewFotoContainer');
    const submitButton = document.getElementById('submitReturnButton');

    function bukaModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    }

    function tutupModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    }

    // Tombol Ajukan Return
    openButtons.forEach(function (button) {
        button.addEventListener('click', bukaModal);
    });

    // Tombol tutup dan batal
    closeButton?.addEventListener('click', tutupModal);
    cancelButton?.addEventListener('click', tutupModal);

    // Tutup jika area luar modal diklik
    modal.addEventListener('click', function (event) {
        if (event.target === modal) {
            tutupModal();
        }
    });

    // Tutup dengan tombol Escape
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
            tutupModal();
        }
    });

    // Buka otomatis kembali jika validasi return gagal
    if (modal.dataset.hasErrors === '1') {
        bukaModal();
    }

    // Jika elemen upload foto tidak tersedia, modal tetap berfungsi
    if (!form || !inputFoto || !previewContainer) {
        return;
    }

    const MAX_FOTO = 5;
    const MAX_SIZE = 5 * 1024 * 1024;
    const TIPE_DIIZINKAN = [
        'image/jpeg',
        'image/png',
        'image/webp'
    ];

    let previewUrls = [];

    function hapusPreview() {
        previewUrls.forEach(function (url) {
            URL.revokeObjectURL(url);
        });

        previewUrls = [];
        previewContainer.replaceChildren();
        previewContainer.classList.add('hidden');
    }

    function resetFoto() {
        inputFoto.value = '';
        hapusPreview();

        if (namaFoto) {
            namaFoto.textContent = 'Belum ada foto yang dipilih.';
        }
    }

    function tampilkanPreview(files) {
        hapusPreview();

        if (files.length === 0) {
            if (namaFoto) {
                namaFoto.textContent = 'Belum ada foto yang dipilih.';
            }
            return;
        }

        if (namaFoto) {
            namaFoto.textContent = files.length + ' foto dipilih.';
        }

        previewContainer.classList.remove('hidden');

        files.forEach(function (file, index) {
            const url = URL.createObjectURL(file);
            previewUrls.push(url);

            const wrapper = document.createElement('div');
            wrapper.className =
                'overflow-hidden rounded-xl border border-gray-200 bg-white';

            const image = document.createElement('img');
            image.src = url;
            image.alt = 'Preview foto ' + (index + 1);
            image.className = 'h-32 w-full object-cover';

            const caption = document.createElement('p');
            caption.className =
                'truncate px-2 py-2 text-xs text-gray-600';
            caption.textContent = file.name;

            wrapper.appendChild(image);
            wrapper.appendChild(caption);
            previewContainer.appendChild(wrapper);
        });
    }

    inputFoto.addEventListener('change', function () {
        const files = Array.from(inputFoto.files || []);

        if (files.length > MAX_FOTO) {
            alert('Maksimal pilih 5 foto.');
            resetFoto();
            return;
        }

        const fileTidakValid = files.find(function (file) {
            return !TIPE_DIIZINKAN.includes(file.type)
                || file.size > MAX_SIZE;
        });

        if (fileTidakValid) {
            alert(
                !TIPE_DIIZINKAN.includes(fileTidakValid.type)
                    ? 'Format foto harus JPG, JPEG, PNG, atau WEBP.'
                    : 'Ukuran setiap foto maksimal 5 MB.'
            );

            resetFoto();
            return;
        }

        tampilkanPreview(files);
    });

    form.addEventListener('submit', function (event) {
        const files = Array.from(inputFoto.files || []);

        if (files.length < 1 || files.length > MAX_FOTO) {
            event.preventDefault();
            alert('Pilih minimal 1 dan maksimal 5 foto bukti.');
            return;
        }

        const fileTidakValid = files.find(function (file) {
            return !TIPE_DIIZINKAN.includes(file.type)
                || file.size > MAX_SIZE;
        });

        if (fileTidakValid) {
            event.preventDefault();
            alert('Periksa format dan ukuran semua foto terlebih dahulu.');
            return;
        }

        if (submitButton) {
            submitButton.disabled = true;
            submitButton.innerHTML =
                '<i class="fa-solid fa-spinner fa-spin mr-1"></i> Mengirim...';
        }
    });

});
