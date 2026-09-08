
document.addEventListener('DOMContentLoaded', function () {

    const input = document.getElementById('foto_profil');
    const preview = document.getElementById('profilePreview');
    const placeholder = document.getElementById('profilePlaceholder');

    if (!input || !preview) return;

    input.addEventListener('change', function () {

        const file = this.files[0];

        if (!file) return;

        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        if (!allowedTypes.includes(file.type)) {

            alert('Format foto harus JPG, PNG, atau WEBP.');

            this.value = '';

            return;
        }


        if (file.size > 2 * 1024 * 1024) {

            alert('Ukuran foto maksimal 2 MB.');

            this.value = '';

            return;
        }


        const reader = new FileReader();

        reader.onload = function (event) {

            preview.src = event.target.result;

            preview.classList.remove('hidden');

            if (placeholder) {
                placeholder.classList.add('hidden');
            }

        };

        reader.readAsDataURL(file);

    });

});
