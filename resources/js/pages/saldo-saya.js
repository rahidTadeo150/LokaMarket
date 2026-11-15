document.addEventListener("DOMContentLoaded", function () {
    const rekeningModal = document.getElementById("rekeningModal");
    const withdrawModal = document.getElementById("withdrawModal");

    window.openModal = function (id) {
        const modal = document.getElementById(id);

        if (!modal) return;

        modal.classList.remove("hidden");
        modal.classList.add("flex");

        document.body.classList.add("overflow-hidden");
    };

    window.closeModal = function (id) {
        const modal = document.getElementById(id);

        if (!modal) return;

        modal.classList.add("hidden");
        modal.classList.remove("flex");

        const rekeningOpen =
            rekeningModal && !rekeningModal.classList.contains("hidden");

        const withdrawOpen =
            withdrawModal && !withdrawModal.classList.contains("hidden");

        if (!rekeningOpen && !withdrawOpen) {
            document.body.classList.remove("overflow-hidden");
        }
    };

    window.openRekeningModal = function () {
        window.openModal("rekeningModal");
    };

    window.closeRekeningModal = function () {
        window.closeModal("rekeningModal");
    };

    window.openWithdrawModal = function () {
        window.openModal("withdrawModal");
    };

    window.closeWithdrawModal = function () {
        window.closeModal("withdrawModal");
    };

    [rekeningModal, withdrawModal].forEach(function (modal) {
        if (!modal) return;

        modal.addEventListener("click", function (event) {
            if (event.target === modal) {
                window.closeModal(modal.id);
            }
        });
    });

    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            window.closeRekeningModal();
            window.closeWithdrawModal();
        }
    });

    const metode = document.getElementById("metode");

    if (metode) {
        const label = document.querySelector('label[for="nama_bank"]');

        const updateLabel = function () {
            if (!label) return;

            label.textContent =
                metode.value === "ewallet"
                    ? "Nama e-wallet / penyedia"
                    : "Nama bank / penyedia";
        };

        metode.addEventListener("change", updateLabel);

        updateLabel();
    }

    const validation = document.getElementById("saldo-modal-validation");

    if (validation) {
        if (validation.dataset.rekeningError === "true") {
            window.openRekeningModal();
        } else if (validation.dataset.withdrawError === "true") {
            window.openWithdrawModal();
        }
    }
});
