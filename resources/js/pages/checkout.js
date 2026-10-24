
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('checkoutForm');
    const button = document.getElementById('checkoutButton');

    const addressModal = document.getElementById('addressAlertModal');
    const addressContent = document.getElementById('addressAlertContent');
    const closeAddressButton = document.getElementById('closeAddressAlert');

    if (!form || !button) return;

    let isSubmitting = false;

    const paymentRadios = form.querySelectorAll('.payment-radio');
    const bankOptions = document.getElementById('bankOptions');
    const bankRadios = form.querySelectorAll('.bank-radio');

    function openAddressModal() {
        if (!addressModal || !addressContent) {
            alert('Silakan tambahkan alamat pengiriman terlebih dahulu.');
            return;
        }

        addressModal.classList.remove('hidden');
        addressModal.classList.add('flex');

        requestAnimationFrame(() => {
            addressContent.classList.remove('scale-95', 'opacity-0');
            addressContent.classList.add('scale-100', 'opacity-100');
        });
    }

    function closeAddressModal() {

        if (!addressModal || !addressContent) return;

        addressContent.classList.remove('scale-100', 'opacity-100');
        addressContent.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            addressModal.classList.add('hidden');
            addressModal.classList.remove('flex');
        }, 200);

    }

    closeAddressButton?.addEventListener('click', closeAddressModal);

    addressModal?.addEventListener('click', function (event) {
        if (event.target === addressModal) {
            closeAddressModal();
        }
    });

    function setLoading(loading) 
    {

        button.disabled = loading;

        if (loading) {

            button.innerHTML = `
                <i class="fa-solid fa-spinner fa-spin text-xs"></i>
                Memproses Pesanan...
            `;
            button.classList.add('cursor-not-allowed', 'opacity-70');

        } else {

            button.innerHTML = `
                <i class="fa-solid fa-lock text-xs"></i>
                Buat Pesanan
            `;
            button.classList.remove('cursor-not-allowed', 'opacity-70');

        }

    }

    function showError(message) {
        alert(message || 'Terjadi kesalahan. Silakan coba kembali.');
    }

    function updatePaymentOptions() 
    {

        const selected = form.querySelector('input[name="payment_method"]:checked');

        const isBankTransfer = selected?.value === 'bank_transfer';

        bankOptions?.classList.toggle('hidden', !isBankTransfer);

        bankRadios.forEach(function (radio) {
            radio.disabled = !isBankTransfer;
            radio.required = isBankTransfer;
        });

        if (isBankTransfer && !form.querySelector('input[name="bank_code"]:checked')) {

            const defaultBank = form.querySelector(
                'input[name="bank_code"][value="bca_va"]'
            );

            if (defaultBank) {
                defaultBank.checked = true;
            }

        }
        
    }

    paymentRadios.forEach(function (radio) {
        radio.addEventListener('change', updatePaymentOptions);
    });

    updatePaymentOptions();

    form.addEventListener('submit', async function (event) {

        event.preventDefault();

        if (isSubmitting) return;

        const hasAddress = form.dataset.hasAddress === 'true';

        if (!hasAddress) {
            openAddressModal();
            return;
        }

        const selectedPayment = form.querySelector('input[name="payment_method"]:checked');

        if (!selectedPayment) {
            showError('Silakan pilih metode pembayaran.');
            return;
        }

        const selectedBank = form.querySelector('input[name="bank_code"]:checked');

        if (selectedPayment.value === 'bank_transfer' && (!selectedBank || selectedBank.disabled)) {
            showError('Silakan pilih bank untuk pembayaran.');
            return;
        }

        if (!window.snap || typeof window.snap.pay !== 'function') {
            showError('Layanan pembayaran belum siap. Muat ulang halaman dan coba kembali.');
            return;
        }

        isSubmitting = true;
        setLoading(true);

        try {

            const payload = {
                catatan: form.querySelector('[name="catatan"]')?.value || '',
                payment_method: selectedPayment.value
            };

            if (selectedPayment.value === 'bank_transfer') {
                payload.bank_code = selectedBank.value;
            }

            const response = await fetch(form.dataset.paymentUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': form.querySelector(
                        'input[name="_token"]'
                    )?.value || '',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(payload)
            });

            const data = await response.json();

            if (!response.ok) {

                if (response.status === 422 && data.errors) {
                    const firstError = Object.values(data.errors).flat()[0];
                    throw new Error(firstError || 'Data checkout tidak valid.');
                }

                throw new Error(data.message || 'Gagal membuat pesanan.');

            }

            if (!data.snap_token) {
                throw new Error('Token pembayaran tidak diterima dari server.');
            }

            window.snap.pay(data.snap_token, {

                onSuccess: function () {
                    isSubmitting = false;
                    setLoading(false);
                    window.location.href = data.status_url;
                },

                onPending: function () {
                    isSubmitting = false;
                    setLoading(false);
                    window.location.href = data.status_url;
                },

                onError: function () {
                    isSubmitting = false;
                    setLoading(false);

                    showError(
                        'Pembayaran gagal diproses. Silakan coba lagi atau pilih metode lain.'
                    );
                },

                onClose: function () {
                    isSubmitting = false;
                    setLoading(false);
                }

            });

        } catch (error) {
            isSubmitting = false;
            setLoading(false);
            showError(error.message);
        }

    });
    
});
