document.addEventListener('DOMContentLoaded', () => {

    const addressForm = document.getElementById('addressForm');
    const submitBtn = document.getElementById('submitBtn');

    const inputForm = {

        label: {
            input: document.getElementById('label'),
            borderField: document.getElementById('label'),
            error: document.getElementById('label-error'),

            validate: (v) => {

                if (!v) {
                    return 'Nama alamat tidak boleh kosong!';
                }

                if (v.length < 2) {
                    return 'Nama alamat minimal 2 karakter!';
                }

                if (v.length > 50) {
                    return 'Nama alamat maksimal 50 karakter!';
                }

                return '';
            }
        },

        nama_penerima: {
            input: document.getElementById('nama_penerima'),
            borderField: document.getElementById('nama_penerima'),
            error: document.getElementById('nama-penerima-error'),

            validate: (v) => {

                if (!v) {
                    return 'Nama penerima tidak boleh kosong!';
                }

                if (v.length < 3) {
                    return 'Nama penerima minimal 3 karakter!';
                }

                if (v.length > 100) {
                    return 'Nama penerima maksimal 100 karakter!';
                }

                if (!/^[a-zA-Z\s.'-]+$/.test(v)) {
                    return 'Nama penerima hanya boleh berisi huruf!';
                }

                return '';
            }
        },

        no_telepon: {
            input: document.getElementById('no_telepon'),
            borderField: document.getElementById('no_telepon'),
            error: document.getElementById('no-telepon-error'),

            validate: (v) => {

                v = v.replace(/\D/g, '');
                v = v.replace(/^0+/, '');

                document.getElementById('no_telepon').value = v;

                if (!v) {
                    return 'Nomor telepon tidak boleh kosong!';
                }

                if (!v.startsWith('8')) {
                    return 'Nomor telepon harus diawali angka 8!';
                }

                if (v.length < 9) {
                    return 'Nomor telepon minimal 9 digit!';
                }

                if (v.length > 14) {
                    return 'Nomor telepon maksimal 14 digit!';
                }

                return '';
            }
        },

        kode_pos: {
            input: document.getElementById('kode_pos'),
            borderField: document.getElementById('kode_pos'),
            error: document.getElementById('kode-pos-error'),

            validate: (v) => {

                v = v.replace(/\D/g, '');
                v = v.substring(0, 5);

                document.getElementById('kode_pos').value = v;

                if (!v) {
                    return 'Kode pos tidak boleh kosong!';
                }

                if (v.length !== 5) {
                    return 'Kode pos harus terdiri dari 5 digit!';
                }

                return '';
            }
        },

        alamat_lengkap: {
            input: document.getElementById('alamat_lengkap'),
            borderField: document.getElementById('alamat_lengkap'),
            error: document.getElementById('alamat-lengkap-error'),

            validate: (v) => {

                if (!v) {
                    return 'Alamat lengkap tidak boleh kosong!';
                }

                if (v.length < 10) {
                    return 'Alamat lengkap minimal 10 karakter!';
                }

                if (v.length > 500) {
                    return 'Alamat lengkap maksimal 500 karakter!';
                }

                return '';
            }
        }

    };


    function validateField(field) {

        if (!field.input) {
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

            if (field.error) {
                field.error.textContent = message;
                field.error.classList.remove('hidden');
            }

            return false;
        }

        field.borderField.classList.add('border-green-400');

        if (field.error) {
            field.error.textContent = '';
            field.error.classList.add('hidden');
        }

        return true;
    }


    function validateLocation() {

        let valid = true;

        const provinsi = document.getElementById('provinsi_id');
        const kota = document.getElementById('kota_id');
        const kecamatan = document.getElementById('kecamatan_id');

        const locationFields = [
            {
                input: provinsi,
                error: document.getElementById('provinsi-error'),
                message: 'Provinsi wajib dipilih!'
            },
            {
                input: kota,
                error: document.getElementById('kota-error'),
                message: 'Kota/Kabupaten wajib dipilih!'
            },
            {
                input: kecamatan,
                error: document.getElementById('kecamatan-error'),
                message: 'Kecamatan wajib dipilih!'
            }
        ];

        locationFields.forEach(field => {

            if (!field.input) {
                return;
            }

            field.input.classList.remove(
                'border-red-400',
                'border-green-400'
            );

            if (!field.input.value) {

                valid = false;

                field.input.classList.add('border-red-400');

                if (field.error) {
                    field.error.textContent = field.message;
                    field.error.classList.remove('hidden');
                }

            } else {

                field.input.classList.add('border-green-400');

                if (field.error) {
                    field.error.textContent = '';
                    field.error.classList.add('hidden');
                }
            }

        });

        return valid;
    }


    function validateForm() {

        let valid = true;

        Object.values(inputForm).forEach(field => {

            if (!validateField(field)) {
                valid = false;
            }

        });

        if (!validateLocation()) {
            valid = false;
        }

        submitBtn.disabled = !valid;

        if (valid) {

            submitBtn.classList.remove(
                'opacity-50',
                'cursor-not-allowed'
            );

        } else {

            submitBtn.classList.add(
                'opacity-50',
                'cursor-not-allowed'
            );
        }

        return valid;
    }


    Object.values(inputForm).forEach(field => {

        if (!field.input) {
            return;
        }

        field.input.addEventListener('input', () => {
            validateField(field);
            validateForm();
        });

        field.input.addEventListener('blur', () => {
            validateField(field);
            validateForm();
        });

    });


    const provinsi = document.getElementById('provinsi_id');
    const kota = document.getElementById('kota_id');
    const kecamatan = document.getElementById('kecamatan_id');

    if (provinsi) {
        provinsi.addEventListener('change', validateForm);
    }

    if (kota) {
        kota.addEventListener('change', validateForm);
    }

    if (kecamatan) {
        kecamatan.addEventListener('change', validateForm);
    }


    addressForm.addEventListener('submit', (event) => {

        if (!validateForm()) {

            event.preventDefault();

            const firstError = Object.values(inputForm).find(field => {

                return field.borderField &&
                    field.borderField.classList.contains('border-red-400');

            });

            if (firstError) {
                firstError.input.focus();
            }

        }

    });


    validateForm();

});