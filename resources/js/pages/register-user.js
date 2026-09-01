window.togglePassword = function (inputId, button) {
    const passwordInput = document.getElementById(inputId);
    const icon = button.querySelector('i');

    const isPassword = passwordInput.type === 'password';

    passwordInput.type = isPassword ? 'text' : 'password';

    button.setAttribute(
        'aria-label',
        isPassword
            ? 'Sembunyikan kata sandi'
            : 'Tampilkan kata sandi'
    );

    icon.classList.toggle('fa-eye', !isPassword);
    icon.classList.toggle('fa-eye-slash', isPassword);
};