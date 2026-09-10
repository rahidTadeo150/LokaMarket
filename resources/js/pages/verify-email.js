document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('resendVerificationForm');
    const button = document.getElementById('resendButton');
    const buttonContent = document.getElementById('resendButtonContent');
    const loading = document.getElementById('resendLoading');

    if (!form) return;

    form.addEventListener('submit', function () {

        button.disabled = true;

        buttonContent.classList.add('hidden');
        buttonContent.classList.remove('flex');

        loading.classList.remove('hidden');
        loading.classList.add('flex');
    });
});