window.closeAlert = function (alertId) {

    const alert = document.getElementById(alertId);

    if (!alert) return;

    alert.classList.add(
        'opacity-0',
        'translate-x-5'
    );

    setTimeout(() => {
        alert.remove();
    }, 300);
};


// Auto close setelah 5 detik
[
    'alert-success',
    'alert-error'
].forEach(alertId => {

    const alert = document.getElementById(alertId);

    if (alert) {
        setTimeout(() => {
            closeAlert(alertId);
        }, 5000);
    }

});

