
document.addEventListener('DOMContentLoaded', function () {

    const input = document.getElementById('foto_profil');
    const preview = document.getElementById('profilePreview');
    const placeholder = document.getElementById('profilePlaceholder');

    if (!input || !preview) return;

    input.addEventListener('change', function () {

        const file = this.files[0];

        if (!file) return;

        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        if (!allowedTypes.includes(file.type)) {

            alert('Format foto harus JPG, PNG, atau WEBP.');

            this.value = '';

            return;
        }


        if (file.size > 2 * 1024 * 1024) {

            alert('Ukuran foto maksimal 2 MB.');

            this.value = '';

            return;
        }


        const reader = new FileReader();

        reader.onload = function (event) {

            preview.src = event.target.result;

            preview.classList.remove('hidden');

            if (placeholder) {
                placeholder.classList.add('hidden');
            }

        };

        reader.readAsDataURL(file);

    });

    
    const submitBtn = document.getElementById('submitBtn');
    const profileForm = document.getElementById('form-edit-profil');

    submitBtn.disabled = true;

    const inputForm = {

        username: {
            input: document.getElementById('username'),
            borderField: document.getElementById('username'),
            error: document.getElementById('username-error'),

            validate: (v) => {

            v = v.replace(/[^a-zA-Z0-9_]/g, '');
            document.getElementById('username').value = v;

                if (!v) {
                    return 'Username tidak boleh kosong!';
                }

                if (v.length < 5) {
                    return 'Username minimal 5 karakter!';
                }

                if (v.length > 20) {
                    return 'Username maksimal 20 karakter!';
                }
                

                return '';
            }
        },

        nama: {
            input: document.getElementById('nama'),
            borderField: document.getElementById('nama'),
            error: document.getElementById('nama-error'),
            validate: (v) => {

                if (!v) {
                    return 'Nama lengkap tidak boleh kosong!';
                }

                if (!/^[a-zA-Z\s]+$/.test(v)) {
                    return 'Nama hanya boleh berisi huruf!';
                }
                
                return '';
            }
        },

        no_telp: {
            input: document.getElementById('no_telp'),
            borderField: document.getElementById('no_telp'),
            error: document.getElementById('no-telp-error'),

            validate: (v) => {

                v = v.replace(/[^\d]/g, '');

                // Menghapus angka 0 di depan
                v = v.replace(/^0+/, '');

                document.getElementById('no_telp').value = v;

                if (!v) {
                    return 'Nomor telepon tidak boleh kosong!';
                }

                if (v.length < 9 || v.length > 14) {
                    return 'Nomor telepon harus 10-15 digit!';
                }

                if (!v.startsWith('8')) {
                    return 'Nomor telepon harus diawali angka 8!';
                }

                return '';
            }
        },

        email: {
            input: document.getElementById('email'),
            borderField: document.getElementById('email'),
            error: document.getElementById('email-error'),

            validate: (v) => {

                if (!v) {
                    return 'Email tidak boleh kosong!';
                }

                if (/\s/.test(v)) {
                    return 'Email tidak boleh ada spasi!';
                }

                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v)) {
                    return 'Format email tidak valid!';
                }

                return '';
            }
        },

        foto_profil: {
            input: document.getElementById('foto_profil'),
            borderField: document.getElementById('foto_profil'),
            error: document.getElementById('foto-profil-error'),

            validate: () => {

                const file = document.getElementById('foto_profil').files[0];

                if (!file) {
                    return '';
                }

                const allowedTypes = [
                    'image/jpeg',
                    'image/png',
                    'image/webp'
                ];

                if (!allowedTypes.includes(file.type)) {
                    return 'Format foto harus JPG, PNG, atau WEBP!';
                }

                const maxSize = 2 * 1024 * 1024;

                if (file.size > maxSize) {
                    return 'Ukuran foto maksimal 2 MB!';
                }

                return '';
            }
        }

    };

    function validateField(field) {

        let value = '';

        if (field.input.type === 'file') {
            value = field.input.files[0] || '';
        } else {
            value = field.input.value.trim();
        }

        const message = field.validate(value);

        if (field.input.type === 'file') {

            field.borderField.classList.remove(
                'border-red-400',
                'border-green-400'
            );

            if (message) {

                field.borderField.classList.add('border-red-400');

                return false;
            }

            if (field.input.files.length > 0) {
                field.borderField.classList.add('border-green-400');
            }

            return true;
        }


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
    // VALIDATE FORM
    // ========================================

    function validateForm() {

        let valid = true;

        Object.values(inputForm).forEach(field => {

            if (!validateField(field)) {
                valid = false;
            }

        });

        submitBtn.disabled = !valid;

        return valid;
    }


    // ========================================
    // EVENT INPUT
    // ========================================

    Object.values(inputForm).forEach(field => {

        field.input.addEventListener('input', () => {

            validateField(field);
            validateForm();

        });


        field.input.addEventListener('blur', () => {

            validateField(field);
            validateForm();

        });

    });


    // ========================================
    // EVENT FOTO
    // ========================================

    inputForm.foto_profil.input.addEventListener('change', () => {

        validateField(inputForm.foto_profil);
        validateForm();

        const file = inputForm.foto_profil.input.files[0];

        if (!file) {
            return;
        }

        // Preview foto
        const preview = document.getElementById('profilePreview');
        const placeholder = document.getElementById('profilePlaceholder');

        if (preview) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
        }

        if (placeholder) {
            placeholder.classList.add('hidden');
        }

    });


    // ========================================
    // SUBMIT FORM
    // ========================================

    profileForm.addEventListener('submit', (e) => {

        if (!validateForm()) {

            e.preventDefault();

            const firstError = Object.values(inputForm)
                .find(field => {

                    return field.borderField.classList.contains(
                        'border-red-400'
                    );

                });


            if (firstError) {

                firstError.input.focus();

            }

            return;
        }

    });


    // ========================================
    // VALIDASI AWAL
    // ========================================

    validateForm();

});