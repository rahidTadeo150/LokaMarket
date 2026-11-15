document.addEventListener("DOMContentLoaded", function () {
    const tabs = document.querySelectorAll(".filter-tab");
    const rows = document.querySelectorAll(".pengajuan-row");

    const emptyRow = document.getElementById("emptyFilterRow");
    const emptyTitle = document.getElementById("emptyFilterTitle");
    const emptyDescription = document.getElementById("emptyFilterDescription");

    const jumlahHasil = document.getElementById("jumlahHasilFilter");

    if (!tabs.length || !emptyRow) return;

    const emptyMessages = {
        all: {
            title: "Belum ada pengajuan toko",
            description: "Pengajuan toko akan muncul di halaman ini.",
        },

        pending: {
            title: "Tidak ada pengajuan menunggu",
            description: "Belum ada pengajuan yang menunggu pemeriksaan admin.",
        },

        approved: {
            title: "Tidak ada pengajuan disetujui",
            description: "Belum ada pengajuan toko yang disetujui.",
        },

        rejected: {
            title: "Tidak ada pengajuan ditolak",
            description: "Belum ada pengajuan toko yang ditolak.",
        },
    };

    function filterPengajuan(status) {
        let jumlah = 0;

        rows.forEach(function (row) {
            const statusPengajuan = row.dataset.status;

            const cocok = status === "all" || statusPengajuan === status;

            row.classList.toggle("hidden", !cocok);

            if (cocok) {
                jumlah++;
            }
        });

        emptyRow.classList.toggle("hidden", jumlah > 0);

        if (jumlah === 0) {
            const message = emptyMessages[status];

            if (message) {
                emptyTitle.textContent = message.title;
                emptyDescription.textContent = message.description;
            }
        }

        if (jumlahHasil) {
            jumlahHasil.textContent = `${jumlah} Toko`;
        }

        tabs.forEach(function (tab) {
            const aktif = tab.dataset.tab === status;

            tab.setAttribute("aria-pressed", String(aktif));

            tab.classList.toggle("bg-[#FF6B00]", aktif);
            tab.classList.toggle("text-white", aktif);
            tab.classList.toggle("shadow-sm", aktif);

            tab.classList.toggle("bg-white", !aktif);
            tab.classList.toggle("text-[#8D776A]", !aktif);
            tab.classList.toggle("border", !aktif);
            tab.classList.toggle("border-orange-100", !aktif);
        });
    }

    tabs.forEach(function (tab) {
        tab.addEventListener("click", function () {
            const status = this.dataset.tab;

            filterPengajuan(status);
        });
    });

    filterPengajuan("all");
});
