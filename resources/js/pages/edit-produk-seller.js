document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('editProdukForm');

    if (!form) return;

    const namaProduk = document.getElementById('namaProduk');
    const kategori = document.getElementById('kategori');
    const harga = document.getElementById('harga');
    const stok = document.getElementById('stok');
    const deskripsi = document.getElementById('deskripsi');

    const hargaPreview = document.getElementById('hargaPreview');
    const jumlahKarakter = document.getElementById('jumlahKarakter');

    const ringkasanKategori = document.getElementById('ringkasanKategori');
    const ringkasanHarga = document.getElementById('ringkasanHarga');
    const ringkasanStok = document.getElementById('ringkasanStok');

    function formatRupiah(nilai) {
        const angka = Number(nilai || 0);

        return 'Rp' + angka.toLocaleString('id-ID');
    }

    // ========================================
    // RINGKASAN PRODUK
    // ========================================
    function updateRingkasan() {
        if (kategori && ringkasanKategori) {
            const pilihan = kategori.options[kategori.selectedIndex];

            ringkasanKategori.textContent = pilihan
                ? pilihan.text
                : '-';
        }

        if (harga) {
            const hargaFormatted = formatRupiah(harga.value);

            if (hargaPreview) {
                hargaPreview.textContent = hargaFormatted;
            }

            if (ringkasanHarga) {
                ringkasanHarga.textContent = hargaFormatted;
            }
        }

        if (stok && ringkasanStok) {
            ringkasanStok.textContent = (stok.value || 0) + ' Pcs';
        }

        if (deskripsi && jumlahKarakter) {
            jumlahKarakter.textContent =
                deskripsi.value.length + '/500';
        }
    }

    [namaProduk, kategori, harga, stok, deskripsi].forEach((input) => {
        if (!input) return;

        input.addEventListener('input', updateRingkasan);
        input.addEventListener('change', updateRingkasan);
    });

    updateRingkasan();

    // ========================================
    // VALIDASI GAMBAR
    // ========================================
    function validasiGambar(file) {
        const tipeDiizinkan = [
            'image/jpeg',
            'image/png',
            'image/webp',
        ];

        if (!tipeDiizinkan.includes(file.type)) {
            return 'Format gambar harus JPG, PNG, atau WEBP.';
        }

        if (file.size > 2 * 1024 * 1024) {
            return 'Ukuran gambar maksimal 2 MB.';
        }

        return null;
    }

    // ========================================
    // THUMBNAIL UTAMA
    // ========================================
    const inputThumbnail = document.getElementById('inputThumbnail');
    const previewThumbnail = document.getElementById('previewThumbnail');
    const btnThumbnail = document.getElementById('btnThumbnail');
    const hapusThumbnail = document.getElementById('hapusThumbnail');
    const namaThumbnail = document.getElementById('namaThumbnail');

    const thumbnailAwal = previewThumbnail
        ? previewThumbnail.getAttribute('src')
        : '';

    let urlThumbnailBaru = null;

    if (btnThumbnail && inputThumbnail) {
        btnThumbnail.addEventListener('click', function () {
            inputThumbnail.click();
        });
    }

    if (inputThumbnail) {
        inputThumbnail.addEventListener('change', function () {
            const file = inputThumbnail.files[0];

            if (!file) return;

            const pesanError = validasiGambar(file);

            if (pesanError) {
                alert(pesanError);
                inputThumbnail.value = '';
                return;
            }

            if (urlThumbnailBaru) {
                URL.revokeObjectURL(urlThumbnailBaru);
            }

            urlThumbnailBaru = URL.createObjectURL(file);

            if (previewThumbnail) {
                previewThumbnail.src = urlThumbnailBaru;
            }

            if (namaThumbnail) {
                namaThumbnail.textContent = file.name;
            }
        });
    }

    if (hapusThumbnail) {
        hapusThumbnail.addEventListener('click', function () {
            // Membatalkan pilihan thumbnail baru.
            // Thumbnail yang tersimpan di database tidak dihapus.
            if (urlThumbnailBaru) {
                URL.revokeObjectURL(urlThumbnailBaru);
                urlThumbnailBaru = null;
            }

            if (inputThumbnail) {
                inputThumbnail.value = '';
            }

            if (previewThumbnail) {
                previewThumbnail.src = thumbnailAwal;
            }

            if (namaThumbnail) {
                namaThumbnail.textContent = '';
            }
        });
    }

    // ========================================
    // FOTO PREVIEW PRODUK
    // ========================================
    const inputFotoPreview = document.getElementById('inputFotoPreview');
    const btnTambahFoto = document.getElementById('btnTambahFoto');
    const gridFoto = document.getElementById('gridFotoPreview');
    const jumlahFotoPreview = document.getElementById('jumlahFotoPreview');
    const pesanFotoPreview = document.getElementById('pesanFotoPreview');
    const fotoDihapusContainer = document.getElementById(
        'fotoDihapusContainer'
    );

    if (
        inputFotoPreview &&
        btnTambahFoto &&
        gridFoto &&
        jumlahFotoPreview &&
        pesanFotoPreview &&
        fotoDihapusContainer
    ) {
        // Hanya berisi foto baru yang belum disimpan ke database.
        let daftarFotoBaru = [];

        function tampilkanPesanFoto(pesan) {
            pesanFotoPreview.textContent = pesan;
            pesanFotoPreview.classList.remove('hidden');
        }

        function sembunyikanPesanFoto() {
            pesanFotoPreview.textContent = '';
            pesanFotoPreview.classList.add('hidden');
        }

        function hitungFotoPreview() {
            return gridFoto.querySelectorAll('.preview-item').length;
        }

        function sinkronisasiInputFoto() {
            const transfer = new DataTransfer();

            daftarFotoBaru.forEach(function (item) {
                transfer.items.add(item.file);
            });

            // Pertahankan seluruh file baru yang masih dipilih
            // agar semuanya terkirim ketika form disubmit.
            inputFotoPreview.files = transfer.files;
        }

        function updateNomorFoto() {
            gridFoto.querySelectorAll('.preview-item').forEach(
                function (item, index) {
                    const nomor = item.querySelector('.nomor-foto');

                    if (nomor) {
                        nomor.textContent = 'Foto ' + (index + 1);
                    }
                }
            );
        }

        function updateJumlahFoto() {
            const jumlah = hitungFotoPreview();

            jumlahFotoPreview.textContent = jumlah + '/4 foto';

            btnTambahFoto.classList.toggle('hidden', jumlah >= 4);
        }

        function buatFotoPreview(file) {
            const urlFoto = URL.createObjectURL(file);
            const wrapper = document.createElement('div');

            wrapper.className =
                'preview-item group relative aspect-square overflow-hidden rounded-xl border border-orange-100 bg-[#FFF9F4]';

            const gambar = document.createElement('img');
            gambar.src = urlFoto;
            gambar.alt = 'Foto preview produk baru';
            gambar.className = 'preview-foto h-full w-full object-cover';

            const tombolHapus = document.createElement('button');
            tombolHapus.type = 'button';
            tombolHapus.className =
                'hapus-foto absolute right-2 top-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white/95 text-red-500 shadow-sm transition hover:bg-red-50';
            tombolHapus.title = 'Batalkan foto baru';
            tombolHapus.setAttribute('aria-label', 'Batalkan foto baru');
            tombolHapus.innerHTML =
                '<i class="fa-solid fa-trash text-xs"></i>';

            const nomor = document.createElement('span');
            nomor.className =
                'nomor-foto absolute bottom-2 left-2 rounded-md bg-black/60 px-2 py-1 text-[9px] font-bold text-white';

            wrapper.append(gambar, tombolHapus, nomor);

            daftarFotoBaru.push({
                file: file,
                wrapper: wrapper,
                url: urlFoto,
            });

            tombolHapus.addEventListener('click', function () {
                URL.revokeObjectURL(urlFoto);

                daftarFotoBaru = daftarFotoBaru.filter(
                    (item) => item.wrapper !== wrapper
                );

                wrapper.remove();

                sinkronisasiInputFoto();
                updateNomorFoto();
                updateJumlahFoto();
                sembunyikanPesanFoto();
            });

            gridFoto.insertBefore(wrapper, btnTambahFoto);
        }

        // Buka pemilih file.
        btnTambahFoto.addEventListener('click', function () {
            sembunyikanPesanFoto();

            if (hitungFotoPreview() >= 4) {
                tampilkanPesanFoto(
                    'Maksimal hanya 4 foto preview.'
                );
                return;
            }

            // Kosongkan input sebelum memilih ulang.
            // File yang sudah dipilih tetap tersimpan di daftarFotoBaru.
            inputFotoPreview.value = '';
            inputFotoPreview.click();
        });

        // Proses foto yang dipilih.
        inputFotoPreview.addEventListener('change', function () {
            const files = Array.from(inputFotoPreview.files);

            sembunyikanPesanFoto();

            for (const file of files) {
                if (hitungFotoPreview() >= 4) {
                    tampilkanPesanFoto(
                        'Maksimal hanya 4 foto preview.'
                    );
                    break;
                }

                const pesanError = validasiGambar(file);

                if (pesanError) {
                    tampilkanPesanFoto(
                        file.name + ': ' + pesanError
                    );
                    continue;
                }

                buatFotoPreview(file);
            }

            sinkronisasiInputFoto();
            updateNomorFoto();
            updateJumlahFoto();
        });

        // Hapus foto lama: kirim ID foto ke controller.
        gridFoto.querySelectorAll(
            '.preview-item[data-foto-id] .hapus-foto'
        ).forEach(function (tombol) {
            tombol.addEventListener('click', function () {
                const wrapper = tombol.closest(
                    '.preview-item[data-foto-id]'
                );

                if (!wrapper) return;

                const fotoId = wrapper.dataset.fotoId;

                if (!fotoId) return;

                // Hindari mengirim ID yang sama lebih dari sekali.
                const sudahDitandai = Array.from(
                    fotoDihapusContainer.querySelectorAll(
                        'input[name="hapus_foto_ids[]"]'
                    )
                ).some((input) => input.value === fotoId);

                if (!sudahDitandai) {
                    const input = document.createElement('input');

                    input.type = 'hidden';
                    input.name = 'hapus_foto_ids[]';
                    input.value = fotoId;

                    fotoDihapusContainer.appendChild(input);
                }

                wrapper.remove();

                updateNomorFoto();
                updateJumlahFoto();
            });
        });

        updateNomorFoto();
        updateJumlahFoto();

        // Lepaskan URL gambar sementara setelah halaman ditinggalkan.
        window.addEventListener('pagehide', function () {
            daftarFotoBaru.forEach(function (item) {
                URL.revokeObjectURL(item.url);
            });
        });
    }

    // ========================================
    // STATUS PRODUK
    // ========================================
    const statusAktif = document.getElementById('statusAktif');
    const statusContainer = document.getElementById('statusContainer');
    const statusLabel = document.getElementById('statusLabel');
    const statusKeterangan = document.getElementById('statusKeterangan');

    if (
        statusAktif &&
        statusContainer &&
        statusLabel &&
        statusKeterangan
    ) {
        function updateStatus() {
            const aktif = statusAktif.checked;

            statusLabel.textContent = aktif
                ? 'Produk Aktif'
                : 'Produk Nonaktif';

            statusKeterangan.textContent = aktif
                ? 'Produk dapat dilihat pelanggan.'
                : 'Produk tidak ditampilkan kepada pelanggan.';

            statusContainer.classList.toggle(
                'border-green-100',
                aktif
            );
            statusContainer.classList.toggle(
                'bg-green-50/70',
                aktif
            );
            statusContainer.classList.toggle(
                'border-gray-200',
                !aktif
            );
            statusContainer.classList.toggle(
                'bg-gray-50',
                !aktif
            );

            statusLabel.classList.toggle('text-green-700', aktif);
            statusLabel.classList.toggle('text-gray-600', !aktif);
        }

        statusAktif.addEventListener('change', updateStatus);
        updateStatus();
    }

    // ========================================
    // SIDEBAR SELLER
    // ========================================
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const openSidebar = document.getElementById('openSidebar');
    const closeSidebar = document.getElementById('closeSidebar');

    function bukaSidebar() {
        if (!sidebar || !overlay) return;

        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
    }

    function tutupSidebar() {
        if (!sidebar || !overlay) return;

        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    }

    if (openSidebar) {
        openSidebar.addEventListener('click', bukaSidebar);
    }

    if (closeSidebar) {
        closeSidebar.addEventListener('click', tutupSidebar);
    }

    if (overlay) {
        overlay.addEventListener('click', tutupSidebar);
    }
});