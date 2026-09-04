document.addEventListener('DOMContentLoaded', () => {

    const submitBtn = document.getElementById('submitBtn');
    const registerForm = document.getElementById('registerForm');

    const inputForm = {
        nama: {
            input: document.getElementById('nama'),
            borderField: document.getElementById('nama'),
            error: document.getElementById('nama-error'),
            validate: (v) => {
                v = v.replace(/[^a-zA-Z\s]/g, '');
                document.getElementById('nama').value = v;
                if (!v) {
                    return 'Nama tidak boleh kosong!';
                }
                if (v.length < 5) {
                    return 'Nama minimal 5 karakter!';
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
                v = v.replace(/^0+/, '');
                document.getElementById('no_telp').value = v;
                if (!v) {
                    return 'Nomor telepon tidak boleh kosong!';
                }

                if (v.length < 10 || v.length > 15) {
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
        password: {
            input: document.getElementById('password'),
            borderField: document.getElementById('password'),
            error: document.getElementById('password-error'),
            validate: (v) => {
                if (!v) {
                    return 'Kata sandi tidak boleh kosong!';
                }
                if (v.length < 8) {
                    return 'Kata sandi minimal 8 karakter!';
                }
                if (/\s/.test(v)) {
                    return 'Kata sandi tidak boleh mengandung spasi!';
                }
                return '';
            }
        },
        konfirmasi_password: {
            input: document.getElementById('konfirmasi-password'),
            borderField: document.getElementById('konfirmasi-password'),
            error: document.getElementById('konfirmasi-password-error'),
            validate: (v) => {
                if (!v) {
                    return 'Konfirmasi kata sandi tidak boleh kosong!';
                }
                const password = document.getElementById('password').value;
                if (v !== password) {
                    return 'Konfirmasi kata sandi tidak sama!';
                }
                return '';
            }
        }
    };
    function validateField(field) {
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
    function validateTerms() {
        const terms = document.getElementById('terms');
        if (!terms.checked) {
            return false;
        }
        return true;
    }
    function validateForm() {
        let valid = true;
        Object.values(inputForm).forEach(field => {
            if (!validateField(field)) {
                valid = false;
            }
        });
        if (!validateTerms()) {
            valid = false;
        }
        submitBtn.disabled = !valid;
        return valid;
    }
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
    document.getElementById('terms').addEventListener('change', () => {
        validateForm();
    });
    registerForm.addEventListener('submit', (e) => {
        if (!validateForm()) {
            e.preventDefault();
            const firstError = Object.values(inputForm)
                .find(field => {
                    return field.borderField.classList.contains('border-red-400');
                });
            if (firstError) {
                firstError.input.focus();
            }
            return;
        }
    });
    submitBtn.disabled = true;

});