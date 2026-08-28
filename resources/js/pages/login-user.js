const passwordInput = document.getElementById('password');
const passwordToggle = document.getElementById('password-toggle');

passwordToggle.addEventListener('click', () => {
    const isPassword = passwordInput.type === 'password';
    passwordInput.type = isPassword ? 'text' : 'password';
    passwordToggle.setAttribute('aria-label', isPassword ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi');
    passwordToggle.querySelector('i').classList.toggle('fa-eye', !isPassword);
    passwordToggle.querySelector('i').classList.toggle('fa-eye-slash', isPassword);
});
