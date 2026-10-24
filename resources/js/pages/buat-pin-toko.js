document.addEventListener('DOMContentLoaded', () => {

    const pinForm = document.getElementById('pinForm');
    const submitBtn = document.getElementById('submitPinBtn');

    if (!pinForm || !submitBtn) {
        return;
    }

    const inputForm = {

        pin: {
            input: document.getElementById('pin'),
            borderField: document.getElementById('pin'),
            error: document.getElementById('pin-error'),

            validate: (v) => {

                v = v.replace(/\D/g, '');

                document.getElementById('pin').value = v;

                if (!v) {
                    return 'PIN toko tidak boleh kosong!';
                }

                if (v.length !== 6) {
                    return 'PIN harus terdiri dari 6 digit!';
                }

                return '';
            }
        },


        pin_confirmation: {
            input: document.getElementById('pin_confirmation'),
            borderField: document.getElementById('pin_confirmation'),
            error: document.getElementById('pin-confirmation-error'),

            validate: (v) => {

                v = v.replace(/\D/g, '');

                document.getElementById('pin_confirmation').value = v;

                if (!v) {
                    return 'Konfirmasi PIN tidak boleh kosong!';
                }

                if (v.length !== 6) {
                    return 'Konfirmasi PIN harus terdiri dari 6 digit!';
                }

                const pin = document.getElementById('pin');

                if (pin && v !== pin.value) {
                    return 'Konfirmasi PIN tidak sama dengan PIN toko!';
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

    function validateForm() {

        let valid = true;

        Object.values(inputForm).forEach(field => {

            if (!validateField(field)) {
                valid = false;
            }

        });

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

            field.input.value = field.input.value.replace(/\D/g, '');
            field.input.value = field.input.value.substring(0, 6);

            validateField(field);

            validateForm();

        });


        field.input.addEventListener('blur', () => {

            validateField(field);

            validateForm();

        });

    });

    pinForm.addEventListener('submit', (event) => {

        if (!validateForm()) {

            event.preventDefault();

            const firstError =
                Object.values(inputForm).find(field => {

                    return field.borderField &&
                        field.borderField.classList.contains(
                            'border-red-400'
                        );

                });

            if (firstError) {
                firstError.input.focus();
            }

        }

    });

    validateForm();

    const passwordToggleButtons = document.querySelectorAll('[data-password-toggle]');

    passwordToggleButtons.forEach(button => {

        button.addEventListener('click', () => {

            const inputId = button.dataset.passwordToggle;
            const input = document.getElementById(inputId);
            const icon = button.querySelector('i');

            if (!input || !icon) {
                return;
            }

            if (input.type === 'password') {

                input.type = 'text';

                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');

                button.setAttribute(
                    'aria-label',
                    'Sembunyikan PIN'
                );

            } else {

                input.type = 'password';

                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');

                button.setAttribute(
                    'aria-label',
                    'Tampilkan PIN'
                );

            }

        });

    })

});