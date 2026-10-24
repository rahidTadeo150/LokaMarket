document.addEventListener('DOMContentLoaded', function () {

    const countdown = document.getElementById('cooldown');

    if (!countdown) {
        return;
    }

    const endTime = Number(countdown.dataset.end) * 1000;

    function updateCountdown() {

        const now = Date.now();
        const distance = endTime - now;

        if (distance <= 0) {

            countdown.textContent = 'Waktu tunggu selesai.';

            clearInterval(timer);

            setTimeout(function () {
                window.location.reload();
            }, 1000);

            return;
        }

        const hours = Math.floor(
            distance / (1000 * 60 * 60)
        );

        const minutes = Math.floor(
            (distance % (1000 * 60 * 60)) / (1000 * 60)
        );

        const seconds = Math.floor(
            (distance % (1000 * 60)) / 1000
        );

        countdown.textContent =
            String(hours).padStart(2, '0') + ':' +
            String(minutes).padStart(2, '0') + ':' +
            String(seconds).padStart(2, '0');
    }

    updateCountdown();

    const timer = setInterval(updateCountdown, 1000);

});