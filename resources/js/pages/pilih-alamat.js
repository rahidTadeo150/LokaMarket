document.addEventListener('DOMContentLoaded', function () {
    const addressRadios = document.querySelectorAll('.address-radio');
    const useAddressButton = document.getElementById('useAddressButton');
    const selectedAddressName = document.getElementById('selectedAddressName');
    const addressAlert = document.getElementById('addressAlert');

    let selectedAddressId = null;

    function updateAddressCards() {

        addressRadios.forEach(function (radio) {

            const card = radio.closest('.address-card');

            if (!card) {
                return;
            }

            const circle = card.querySelector('.radio-circle');
            const dot = circle ? circle.querySelector('.radio-dot') : null;

            if (radio.checked) {

                if (circle) {

                    circle.classList.remove('border-[#DCCBC0]');

                    circle.classList.add(
                        'border-orange-500',
                        'bg-white',
                        'border-5'
                    );

                }

                if (dot) {
                    dot.classList.remove('hidden');
                }

                card.classList.remove('border-orange-100');

                card.classList.add(
                    'border-orange-300',
                    'shadow-md'
                );

            } else {

                if (circle) {

                    circle.classList.remove(
                        'border-orange-500',
                        'bg-white',
                        'border-5'
                    );

                    circle.classList.add(
                        'border-[#DCCBC0]'
                    );

                }

                if (dot) {
                    dot.classList.add('hidden');
                }

                card.classList.remove(
                    'border-orange-300',
                    'shadow-md'
                );

                card.classList.add('border-orange-100');
            }

        });
    }

    addressRadios.forEach(function (radio) {

        if (radio.checked) {

            selectedAddressId = radio.value;

            if (selectedAddressName) {
                selectedAddressName.textContent = radio.dataset.address || 'Alamat terpilih';
            }

        }

    });

    updateAddressCards();

    addressRadios.forEach(function (radio) {

        radio.addEventListener('change', function () {

            if (!this.checked) {
                return;
            }

            this.checked = true;

            selectedAddressId = this.value;

            if (selectedAddressName) {
                selectedAddressName.textContent = this.dataset.address || 'Alamat terpilih';
            }

            updateAddressCards();

        });

    });

    if (useAddressButton) {

        useAddressButton.addEventListener('click', async function () {

            if (!selectedAddressId) {
                alert('Silakan pilih alamat terlebih dahulu.');
                return;
            }


            const originalHTML = useAddressButton.innerHTML;

            useAddressButton.disabled = true;

            useAddressButton.innerHTML = `
                <i class="fa-solid fa-spinner fa-spin text-xs"></i>
                Menyimpan...
            `;

            try {

                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                if (!csrfToken) {
                    throw new Error('CSRF token tidak ditemukan.');
                }


                const response = await fetch(
                    `/alamat/${selectedAddressId}/set-default`,
                    {
                        method: 'POST',

                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    }
                );


                const data = await response.json();


                if (!response.ok || !data.success) {

                    throw new Error(
                        data.message ||
                        'Gagal menyimpan alamat.'
                    );

                }

                if (addressAlert) {
                    addressAlert.classList.remove('hidden');
                    addressAlert.classList.add('flex');
                }


                useAddressButton.disabled = false;

                useAddressButton.innerHTML = `
                    <i class="fa-solid fa-check text-xs"></i>
                    Alamat Digunakan
                `;


                setTimeout(function () {
                    window.location.reload();
                }, 2000);


            } catch (error) {

                console.error(
                    'Gagal menyimpan alamat:',
                    error
                );

                alert(
                    error.message ||
                    'Terjadi kesalahan saat menyimpan alamat.'
                );


                useAddressButton.disabled = false;

                useAddressButton.innerHTML = originalHTML;

            }

        });

    }

});