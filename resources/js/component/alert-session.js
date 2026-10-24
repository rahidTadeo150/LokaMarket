document.addEventListener('DOMContentLoaded', function () {
    const alert = document.getElementById('session-alert');
    const closeButton = document.getElementById('close-session-alert');

    if (!alert) {
        return;
    }

    function closeAlert() {

        alert.classList.add(
            'opacity-0',
            'translate-y-[-8px]'
        );

        setTimeout(function () {
            alert.remove();
        }, 300);
    }

    if (closeButton) {
        closeButton.addEventListener('click', closeAlert);
    }

    setTimeout(function () {
        closeAlert();
    }, 4000);

});