document.addEventListener("DOMContentLoaded", function () {
    const notificationWrapper = document.getElementById("notificationWrapper");

    const notificationButton = document.getElementById("notificationButton");

    const notificationDropdown = document.getElementById(
        "notificationDropdown",
    );

    if (!notificationWrapper || !notificationButton || !notificationDropdown) {
        return;
    }

    notificationButton.addEventListener("click", function (event) {
        event.stopPropagation();

        const isOpen = !notificationDropdown.classList.contains("hidden");

        notificationDropdown.classList.toggle("hidden", isOpen);

        notificationButton.setAttribute("aria-expanded", String(!isOpen));
    });

    notificationDropdown.addEventListener("click", function (event) {
        event.stopPropagation();
    });

    document.addEventListener("click", function (event) {
        if (!notificationWrapper.contains(event.target)) {
            notificationDropdown.classList.add("hidden");

            notificationButton.setAttribute("aria-expanded", "false");
        }
    });

    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            notificationDropdown.classList.add("hidden");

            notificationButton.setAttribute("aria-expanded", "false");
        }
    });
});
