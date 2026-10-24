document.addEventListener('DOMContentLoaded', function () {
    const showRejectButton = document.getElementById('showRejectButton');
    const cancelRejectButton = document.getElementById('cancelRejectButton');
    const rejectForm = document.getElementById('rejectForm');
    const alasanPenolakan = document.getElementById('alasan_penolakan');
    const rejectCharCount = document.getElementById('rejectCharCount');

    if (showRejectButton && rejectForm) {

        showRejectButton.addEventListener('click', function () {

            showRejectButton.classList.add('hidden');
            rejectForm.classList.remove('hidden');

            if (alasanPenolakan) {
                alasanPenolakan.focus();
            }

        });
    }

    if (cancelRejectButton && rejectForm) {
        
        cancelRejectButton.addEventListener('click', function () {

            rejectForm.classList.add('hidden');

            if (showRejectButton) {
                showRejectButton.classList.remove('hidden');
            }

            if (alasanPenolakan) {
                alasanPenolakan.value = '';
            }

            if (rejectCharCount) {
                rejectCharCount.textContent = '0 / 500';
            }

        });
    }

    if (alasanPenolakan && rejectCharCount) {

        alasanPenolakan.addEventListener('input', function () {

            const length = alasanPenolakan.value.length;

            rejectCharCount.textContent = `${length} / 500`;

        });

    }

});