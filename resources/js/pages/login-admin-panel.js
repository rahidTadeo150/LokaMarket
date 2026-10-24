document.addEventListener('DOMContentLoaded', function () {

    const passwordInput = document.getElementById('password');
    const passwordIcon = document.getElementById('passwordIcon');
    const togglePasswordButton = document.getElementById('togglePasswordButton');

    if (!passwordInput || !passwordIcon || !togglePasswordButton ) {
        return;
    }

    togglePasswordButton.addEventListener('click', function () {

        const isPassword = passwordInput.type === 'password';

        passwordInput.type = isPassword ? 'text' : 'password';

        passwordIcon.classList.toggle('fa-eye', !isPassword);
        passwordIcon.classList.toggle('fa-eye-slash', isPassword);

        togglePasswordButton.setAttribute('aria-label', isPassword ? 'Sembunyikan password' : 'Tampilkan password');
        
    });

});