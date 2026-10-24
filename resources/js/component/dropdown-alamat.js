document.addEventListener('DOMContentLoaded', function () {

    const addressDropdown = document.querySelector('.dropdown-alamat');

    if (!addressDropdown) {
        return;
    }

    const provinsi = addressDropdown.querySelector('#provinsi');
    const kota = addressDropdown.querySelector('#kota');
    const kecamatan = addressDropdown.querySelector('#kecamatan');


    if (!provinsi || !kota || !kecamatan) {
        return;
    }

    const selectedProvinsi = addressDropdown.dataset.selectedProvinsi || '';
    const selectedKota = addressDropdown.dataset.selectedKota || '';
    const selectedKecamatan = addressDropdown.dataset.selectedKecamatan || '';

    function resetKota() {

        kota.innerHTML = `
            <option value="">
                Pilih Kota / Kabupaten
            </option>
        `;

        kota.disabled = true;

        resetKecamatan();
    }

    function resetKecamatan() {

        kecamatan.innerHTML = `
            <option value="">
                Pilih Kecamatan
            </option>
        `;

        kecamatan.disabled = true;
    }

    async function loadKota(provinsiId, selectedId = '') {

        if (!provinsiId) {
            resetKota();
            return;
        }

        kota.disabled = true;

        kota.innerHTML = `
            <option value="">
                Memuat kota...
            </option>
        `;

        try {

            const response = await fetch(
                `/regions/kota/${provinsiId}`
            );

            if (!response.ok) {
                throw new Error('Gagal mengambil data kota.');
            }

            const data = await response.json();

            kota.innerHTML = `
                <option value="">
                    Pilih Kota / Kabupaten
                </option>
            `;

            data.forEach(function (item) {

                const option = document.createElement('option');

                option.value = item.id;
                option.textContent = item.nama;

                if (String(selectedId) === String(item.id)) {

                    option.selected = true;

                }

                kota.appendChild(option);

            });

            kota.disabled = false;

        } catch (error) {

            console.error(error);

            kota.innerHTML = `
                <option value="">
                    Gagal memuat kota
                </option>
            `;

            kota.disabled = true;

        }
    }

    async function loadKecamatan(kotaId, selectedId = '') {

        if (!kotaId) {

            resetKecamatan();

            return;
        }

        kecamatan.disabled = true;

        kecamatan.innerHTML = `
            <option value="">
                Memuat kecamatan...
            </option>
        `;

        try {

            const response = await fetch(
                `/regions/kecamatan/${kotaId}`
            );

            if (!response.ok) {
                throw new Error('Gagal mengambil data kecamatan.');
            }

            const data = await response.json();

            kecamatan.innerHTML = `
                <option value="">
                    Pilih Kecamatan
                </option>
            `;

            data.forEach(function (item) {

                const option = document.createElement('option');

                option.value = item.id;
                option.textContent = item.nama;

                if (String(selectedId) === String(item.id)) {

                    option.selected = true;

                }

                kecamatan.appendChild(option);

            });

            kecamatan.disabled = false;

        } catch (error) {

            console.error(error);

            kecamatan.innerHTML = `
                <option value="">
                    Gagal memuat kecamatan
                </option>
            `;

            kecamatan.disabled = true;
        }
    }

    provinsi.addEventListener('change', function () {

        const provinsiId = this.value;

        resetKota();

        if (provinsiId) {
            loadKota(provinsiId);
        }

    });

    kota.addEventListener('change', function () {

        const kotaId = this.value;

        resetKecamatan();

        if (kotaId) {
            loadKecamatan(kotaId);
        }

    });

    if (selectedProvinsi) {

        loadKota(selectedProvinsi, selectedKota).then(function () {

            if (selectedKota) {
                loadKecamatan(selectedKota,selectedKecamatan);
            }

        });

    }

});