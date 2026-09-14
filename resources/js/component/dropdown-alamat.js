document.addEventListener('DOMContentLoaded', function () {

    const provinsi = document.getElementById('provinsi');
    const kota = document.getElementById('kota');
    const kecamatan = document.getElementById('kecamatan');


    // ==========================
    // PROVINSI → KOTA
    // ==========================

    provinsi.addEventListener('change', function () {

        const provinsiId = this.value;

        kota.innerHTML = '<option value="">Pilih Kota / Kabupaten</option>';
        kecamatan.innerHTML = '<option value="">Pilih Kecamatan</option>';

        kota.disabled = true;
        kecamatan.disabled = true;

        if (!provinsiId) {
            return;
        }

        kota.innerHTML = '<option value="">Memuat kota...</option>';

        fetch(`/regions/kota/${provinsiId}`)
            .then(response => response.json())
            .then(data => {

                kota.innerHTML =
                    '<option value="">Pilih Kota / Kabupaten</option>';

                data.forEach(item => {

                    const option = document.createElement('option');

                    option.value = item.id;
                    option.textContent = item.nama;

                    kota.appendChild(option);

                });

                kota.disabled = false;

            })
            .catch(error => {

                console.error(error);

                kota.innerHTML =
                    '<option value="">Gagal memuat kota</option>';

            });

    });


    // ==========================
    // KOTA → KECAMATAN
    // ==========================

    kota.addEventListener('change', function () {

        const kotaId = this.value;

        kecamatan.innerHTML =
            '<option value="">Pilih Kecamatan</option>';

        kecamatan.disabled = true;

        if (!kotaId) {
            return;
        }

        kecamatan.innerHTML =
            '<option value="">Memuat kecamatan...</option>';

        fetch(`/regions/kecamatan/${kotaId}`)
            .then(response => response.json())
            .then(data => {

                kecamatan.innerHTML =
                    '<option value="">Pilih Kecamatan</option>';

                data.forEach(item => {

                    const option = document.createElement('option');

                    option.value = item.id;
                    option.textContent = item.nama;

                    kecamatan.appendChild(option);

                });

                kecamatan.disabled = false;

            })
            .catch(error => {

                console.error(error);

                kecamatan.innerHTML =
                    '<option value="">Gagal memuat kecamatan</option>';

            });

    });

});