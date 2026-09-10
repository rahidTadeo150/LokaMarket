document.addEventListener('DOMContentLoaded', function () {
    const button = document.getElementById('btnKeuntungan');
    const section = document.getElementById('keuntungan');

    if (!button || !section) return;

    button.addEventListener('click', function (e) {

        e.preventDefault();

        section.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });

    });

});