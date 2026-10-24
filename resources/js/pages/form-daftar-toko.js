// document.addEventListener('DOMContentLoaded', function () {

//     function validateField(input, errorElement, validator) {

//         if (!input || !errorElement) {
//             return true;
//         }

//         const value = input.value.trim();
//         const message = validator(value);

//         input.classList.remove(
//             'border-red-400',
//             'border-green-400'
//         );

//         if (message) {
//             input.classList.add('border-red-400');
//             errorElement.textContent = message;
//             errorElement.classList.remove('hidden');

//             return false;
//         }

//         input.classList.add('border-green-400');
//         errorElement.textContent = '';
//         errorElement.classList.add('hidden');

//         return true;

//     }

//     const namaTokoInput = document.getElementById('nama_toko');
//     const namaTokoError = document.getElementById('nama-toko-error');
//     const deskripsiInput = document.getElementById('deskripsi');
//     const deskripsiError = document.getElementById('deskripsi-error');
//     const fotoProfilInput = document.getElementById('foto_profil');
//     const fotoProfilError = document.getElementById('foto-profil-error');
//     const fotoProfilName = document.getElementById('foto-profil-name');

//     const provinsiInput = document.getElementById('provinsi');
//     const provinsiError = document.getElementById('provinsi-error');
//     const kotaInput = document.getElementById('kota');
//     const kotaError = document.getElementById('kota-error');
//     const kecamatanInput = document.getElementById('kecamatan');
//     const kecamatanError = document.getElementById('kecamatan-error');
//     const kodePosInput = document.getElementById('kode_pos');
//     const kodePosError = document.getElementById('kode-pos-error');
//     const alamatLengkapInput = document.getElementById('alamat_lengkap');
//     const alamatLengkapError = document.getElementById('alamat-lengkap-error');
//     const noTeleponInput = document.getElementById('no_telepon');
//     const noTeleponError = document.getElementById('no-telepon-error');

//     const persetujuanInput = document.getElementById('persetujuan');
//     const persetujuanError = document.getElementById('persetujuan-error');
//     const fotoKtpError = document.getElementById('foto-ktp-error');

//     function validateNamaToko() {

//         return validateField(
//             namaTokoInput,
//             namaTokoError,
//             function (value) {

//                 if (!value) {
//                     return 'Nama toko tidak boleh kosong!';
//                 }

//                 if (value.length < 3) {
//                     return 'Nama toko minimal 3 karakter!';
//                 }

//                 if (value.length > 100) {
//                     return 'Nama toko maksimal 100 karakter!';
//                 }

//                 return '';

//             }
//         );
//     }

//     function validateDeskripsi() {
//         return validateField(
//             deskripsiInput,
//             deskripsiError,
//             function (value) {

//                 if (!value) {
//                     return 'Deskripsi toko tidak boleh kosong!';
//                 }

//                 if (value.length < 10) {
//                     return 'Deskripsi toko minimal 10 karakter!';
//                 }

//                 if (value.length > 500) {
//                     return 'Deskripsi toko maksimal 500 karakter!';
//                 }

//                 return '';

//             }
//         );
//     }

//     function validateFotoProfil() {

//         if (!fotoProfilInput || !fotoProfilError) {
//             return true;
//         }


//         if (!fotoProfilInput.files || fotoProfilInput.files.length === 0) {
//             fotoProfilError.textContent = 'Foto profil toko wajib diunggah!';
//             fotoProfilError.classList.remove('hidden');

//             return false;
//         }

//         const file = fotoProfilInput.files[0];

//         const allowedTypes = [
//             'image/jpeg',
//             'image/png'
//         ];

//         if (!allowedTypes.includes(file.type)) {
//             fotoProfilError.textContent = 'Format foto harus JPG, JPEG, atau PNG!';
//             fotoProfilError.classList.remove('hidden');

//             return false;
//         }

//         if (file.size > 2 * 1024 * 1024) {
//             fotoProfilError.textContent = 'Ukuran foto profil maksimal 2 MB!';
//             fotoProfilError.classList.remove('hidden');

//             return false;
//         }

//         fotoProfilError.textContent = '';
//         fotoProfilError.classList.add('hidden');

//         return true;

//     }

//     function validateProvinsi() {
//         return validateField(
//             provinsiInput,
//             provinsiError,
//             function (value) {

//                 if (!value) {
//                     return 'Provinsi harus dipilih!';
//                 }

//                 return '';

//             }
//         );
//     }

//     function validateKota() {
//         return validateField(
//             kotaInput,
//             kotaError,
//             function (value) {

//                 if (!value) {
//                     return 'Kota / Kabupaten harus dipilih!';
//                 }

//                 return '';

//             }
//         );
//     }

//     function validateKecamatan() {
//         return validateField(
//             kecamatanInput,
//             kecamatanError,
//             function (value) {

//                 if (!value) {
//                     return 'Kecamatan harus dipilih!';
//                 }

//                 return '';

//             }
//         );
//     }

//     function validateKodePos() {
//         return validateField(
//             kodePosInput,
//             kodePosError,
//             function (value) {

//                 if (!value) {
//                     return 'Kode pos tidak boleh kosong!';
//                 }

//                 if (!/^\d{5}$/.test(value)) {
//                     return 'Kode pos harus terdiri dari 5 digit!';
//                 }

//                 return '';

//             }
//         );
//     }

//     function validateAlamatLengkap() {
//         return validateField(
//             alamatLengkapInput,
//             alamatLengkapError,
//             function (value) {

//                 if (!value) {
//                     return 'Alamat lengkap tidak boleh kosong!';
//                 }

//                 if (value.length < 10) {
//                     return 'Alamat lengkap minimal 10 karakter!';
//                 }

//                 if (value.length > 500) {
//                     return 'Alamat lengkap maksimal 500 karakter!';
//                 }

//                 return '';

//             }
//         );
//     }

//     function validateNoTelepon() {

//         if (!noTeleponInput || !noTeleponError) {
//             return true;
//         }

//         let value = noTeleponInput.value.replace(/\D/g, '');

//         noTeleponInput.value = value;
//         noTeleponInput.classList.remove(
//             'border-red-400',
//             'border-green-400'
//         );

//         if (!value) {
//             noTeleponInput.classList.add('border-red-400');
//             noTeleponError.textContent = 'Nomor telepon tidak boleh kosong!';
//             noTeleponError.classList.remove('hidden');

//             return false;
//         }

//         if (!value.startsWith('8')) {
//             noTeleponInput.classList.add('border-red-400');
//             noTeleponError.textContent = 'Nomor telepon harus diawali angka 8!';
//             noTeleponError.classList.remove('hidden');

//             return false;
//         }

//         if (value.length < 9 || value.length > 14) {
//             noTeleponInput.classList.add('border-red-400');
//             noTeleponError.textContent = 'Nomor telepon harus 9-14 digit setelah angka 0!';
//             noTeleponError.classList.remove('hidden');
//             return false;
//         }

//         noTeleponInput.classList.add('border-green-400');
//         noTeleponError.textContent = '';
//         noTeleponError.classList.add('hidden');

//         return true;

//     }

//     function validateFotoKtp() {

//         const fotoKtp = document.getElementById('foto_ktp');

//         if (!fotoKtp || !fotoKtpError) {
//             return true;
//         }

//         if (!fotoKtp.files || fotoKtp.files.length === 0) {
//             fotoKtpError.textContent = 'Foto KTP wajib diunggah!';
//             fotoKtpError.classList.remove('hidden');

//             return false;
//         }

//         const file = fotoKtp.files[0];

//         const allowedTypes = [
//             'image/jpeg',
//             'image/png'
//         ];

//         if (!allowedTypes.includes(file.type)) {
//             fotoKtpError.textContent = 'Format foto KTP harus JPG, JPEG, atau PNG!';
//             fotoKtpError.classList.remove('hidden');

//             return false;
//         }

//         if (file.size > 2 * 1024 * 1024) {
//             fotoKtpError.textContent = 'Ukuran foto KTP maksimal 2 MB!';
//             fotoKtpError.classList.remove('hidden');

//             return false;
//         }

//         fotoKtpError.textContent = '';
//         fotoKtpError.classList.add('hidden');

//         return true;

//     }

//     function validatePersetujuan() {

//         if (!persetujuanInput || !persetujuanError) {
//             return true;
//         }
//         if (!persetujuanInput.checked) {
//             persetujuanError.textContent = 'Kamu harus menyetujui syarat dan ketentuan!';
//             persetujuanError.classList.remove('hidden');

//             return false;
//         }

//         persetujuanError.textContent = '';
//         persetujuanError.classList.add('hidden');

//         return true;

//     }

//     let currentStep = 1;
//     const step1 = document.getElementById('form-step-1');
//     const step2 = document.getElementById('form-step-2');
//     const step3 = document.getElementById('form-step-3');
//     const form = document.getElementById('tokoForm');

//     const stepCircles = {
//         1: document.getElementById('stepCircle1'),
//         2: document.getElementById('stepCircle2'),
//         3: document.getElementById('stepCircle3'),
//     };

//     const stepNumbers = {
//         1: document.getElementById('stepNumber1'),
//         2: document.getElementById('stepNumber2'),
//         3: document.getElementById('stepNumber3'),
//     };

//     const stepSmall = {
//         1: document.getElementById('stepSmall1'),
//         2: document.getElementById('stepSmall2'),
//         3: document.getElementById('stepSmall3'),
//     };

//     const stepLabels = {
//         1: document.getElementById('stepLabel1'),
//         2: document.getElementById('stepLabel2'),
//         3: document.getElementById('stepLabel3'),
//     };

//     const stepLine1 = document.getElementById('stepLine1');
//     const stepLine2 = document.getElementById('stepLine2');

//     function showStep(step) {

//         currentStep = step;

//         step1.classList.add('hidden');
//         step2.classList.add('hidden');
//         step3.classList.add('hidden');

//         if (step === 1) {
//             step1.classList.remove('hidden');
//         }

//         if (step === 2) {
//             step2.classList.remove('hidden');
//         }

//         if (step === 3) {
//             step3.classList.remove('hidden');
//         }

//         updateStepper(step);

//     }

//     function updateStepper(activeStep) {

//         for (let i = 1; i <= 3; i++) {

//             const circle = stepCircles[i];
//             const number = stepNumbers[i];
//             const small = stepSmall[i];
//             const label = stepLabels[i];

//             circle.classList.remove(
//                 'bg-orange-500',
//                 'text-white',
//                 'shadow-lg',
//                 'shadow-orange-200',
//                 'border-2',
//                 'border-orange-200',
//                 'bg-orange-50',
//                 'text-orange-400'
//             );

//             small.classList.remove(
//                 'text-orange-500',
//                 'text-[#A89588]'
//             );

//             label.classList.remove(
//                 'text-[#3B2115]',
//                 'text-orange-500',
//                 'text-[#A89588]'
//             );

//             if (i < activeStep) {

//                 circle.classList.add(
//                     'bg-orange-500',
//                     'text-white',
//                     'shadow-lg',
//                     'shadow-orange-200'
//                 );

//                 number.innerHTML =
//                     '<i class="fa-solid fa-check text-xs"></i>';

//                 small.classList.add('text-orange-500');
//                 label.classList.add('text-orange-500');
//             }

//             else if (i === activeStep) {

//                 circle.classList.add(
//                     'bg-orange-500',
//                     'text-white',
//                     'shadow-lg',
//                     'shadow-orange-200'
//                 );
//                 number.textContent = i;
//                 small.classList.add('text-orange-500');
//                 label.classList.add('text-[#3B2115]');

//             } else {

//                 circle.classList.add(
//                     'border-2',
//                     'border-orange-200',
//                     'bg-orange-50',
//                     'text-orange-400'
//                 );

//                 number.textContent = i;
//                 small.classList.add('text-[#A89588]');
//                 label.classList.add('text-[#A89588]');

//             }
//         }

//         if (activeStep >= 2) {
//             stepLine1.classList.remove('bg-orange-100');
//             stepLine1.classList.add('bg-orange-500');
//         } else {
//             stepLine1.classList.remove('bg-orange-500');
//             stepLine1.classList.add('bg-orange-100');
//         }

//         if (activeStep >= 3) {
//             stepLine2.classList.remove('bg-orange-100');
//             stepLine2.classList.add('bg-orange-500');
//         } else {
//             stepLine2.classList.remove('bg-orange-500');
//             stepLine2.classList.add('bg-orange-100');
//         }

//     }

//     const ktpInput = document.getElementById('foto_ktp');
//     const ktpFileName = document.getElementById('ktpFileName');

//     if (ktpInput && ktpFileName) {

//         ktpInput.addEventListener('change', function () {

//             if (this.files && this.files.length > 0) {

//                 const file = this.files[0];

//                 ktpFileName.textContent = `File dipilih: ${file.name}`;
//                 ktpFileName.classList.remove('hidden');

//             } else {

//                 ktpFileName.textContent = '';
//                 ktpFileName.classList.add('hidden');

//             }

//         });

//     }

//     const previewImage = document.getElementById('previewImage');
//     const defaultStoreIcon = document.getElementById('defaultStoreIcon');
//     const previewName = document.getElementById('previewName');
//     const previewDescription = document.getElementById('previewDescription');

//     const uploadStoreIcon = document.getElementById('uploadStoreIcon');
//     const uploadStorePreview = document.getElementById('uploadStorePreview');

//     if (fotoProfilInput && uploadStoreIcon && uploadStorePreview) {
//         fotoProfilInput.addEventListener('change', function () {

//             const file = this.files[0];

//             if (!file) {

//                 uploadStorePreview.src = '';
//                 uploadStorePreview.classList.add('hidden');
//                 uploadStoreIcon.classList.remove('hidden');

//                 if (previewImage) {
//                     previewImage.src = '';
//                     previewImage.classList.add('hidden');
//                 }

//                 if (defaultStoreIcon) {
//                     defaultStoreIcon.classList.remove('hidden');
//                 }

//                 if (fotoProfilName) {
//                     fotoProfilName.textContent = '';
//                     fotoProfilName.classList.add('hidden');
//                 }

//                 return;

//             }

//             if (!validateFotoProfil()) {

//                 this.value = '';
//                 uploadStorePreview.src = '';
//                 uploadStorePreview.classList.add('hidden');
//                 uploadStoreIcon.classList.remove('hidden');

//                 return;

//             }

//             const imageUrl = URL.createObjectURL(file);

//             uploadStorePreview.src = imageUrl;
//             uploadStorePreview.classList.remove('hidden');
//             uploadStoreIcon.classList.add('hidden');

//             if (previewImage) {
//                 previewImage.src = imageUrl;
//                 previewImage.classList.remove('hidden');
//             }

//             if (defaultStoreIcon) {
//                 defaultStoreIcon.classList.add('hidden');
//             }

//             if (fotoProfilName) {
//                 fotoProfilName.textContent = `File dipilih: ${file.name}`;
//                 fotoProfilName.classList.remove('hidden');
//             }

//         });

//     }

//     if (namaTokoInput && previewName) {
//         namaTokoInput.addEventListener('input', function () {
//             const value = this.value.trim();
//             previewName.textContent = value || 'Nama Toko';
//         });
//     }

//     if (deskripsiInput && previewDescription) {
//         deskripsiInput.addEventListener('input', function () {
//             const value = this.value.trim();
//             previewDescription.textContent = value || 'Deskripsi toko akan tampil di sini';
//         });
//     }

//     showStep(1);

//     function validateStep1() {

//         const namaValid = validateNamaToko();
//         const deskripsiValid = validateDeskripsi();
//         const fotoValid = validateFotoProfil();

//         return namaValid && deskripsiValid && fotoValid;

//     }

//     function validateStep2() {

//         const provinsiValid = validateProvinsi();
//         const kotaValid = validateKota();
//         const kecamatanValid = validateKecamatan();
//         const kodePosValid = validateKodePos();
//         const alamatValid = validateAlamatLengkap();
//         const teleponValid = validateNoTelepon();

//         return (
//             provinsiValid &&
//             kotaValid &&
//             kecamatanValid &&
//             kodePosValid &&
//             alamatValid &&
//             teleponValid
//         );

//     }

//     function validateStep3() {

//         const fotoValid = validateFotoKtp();
//         const persetujuanValid = validatePersetujuan();

//         return fotoValid && persetujuanValid;

//     }

//     document.getElementById('nextStep1')
//         ?.addEventListener('click', function (event) {
//             event.preventDefault();

//             if (!validateStep1()) {
//                 return;
//             }

//             showStep(2);
//         });

//     document.getElementById('prevStep2')
//         ?.addEventListener('click', function (event) {
//             event.preventDefault();

//             showStep(1);
//         });

//     document.getElementById('nextStep2')
//         ?.addEventListener('click', function (event) {
//             event.preventDefault();

//             if (!validateStep2()) {
//                 return;
//             }

//             showStep(3);
//         });

//     document.getElementById('prevStep3')
//         ?.addEventListener('click', function (event) {
//             event.preventDefault();

//             showStep(2);
//         });

//     form?.addEventListener('submit', function (event) {

//         const step1Valid = validateStep1();
//         const step2Valid = validateStep2();
//         const step3Valid = validateStep3();

//         if (!step1Valid || !step2Valid || !step3Valid) {
//             event.preventDefault();

//             if (!step1Valid) {
//                 showStep(1);
//                 return;
//             }

//             if (!step2Valid) {
//                 showStep(2);
//                 return;
//             }

//             if (!step3Valid) {
//                 showStep(3);
//                 return;
//             }

//         }
//     });

//     const container = document.getElementById('lokasiContainer');
//     const kecamatanSelect = document.getElementById('kecamatan');
//     const lokasiSelect = document.getElementById('location_mapping_id');
//     const message = document.getElementById('locationMessage');

//     if (
//         !container ||
//         !kecamatanSelect ||
//         !lokasiSelect ||
//         !kodePosInput ||
//         !message
//     ) {
//         return;
//     }

//     const baseUrl = container.dataset.url;
//     const oldMappingId = lokasiSelect.dataset.old;

//     async function cariLokasi() {
//         const kecamatanId = kecamatanSelect.value;

//         lokasiSelect.innerHTML =
//             '<option value="">Pilih lokasi pengiriman</option>';

//         lokasiSelect.disabled = true;
//         kodePosInput.value = '';

//         if (!kecamatanId) {
//             message.textContent = 'Pilih kecamatan terlebih dahulu.';
//             return;
//         }

//         message.textContent = 'Sedang mencari lokasi...';

//         try {
//             const response = await fetch(
//                 `${baseUrl}/${encodeURIComponent(kecamatanId)}/mapping`,
//                 {
//                     headers: {
//                         Accept: 'application/json',
//                     },
//                 }
//             );

//             const result = await response.json();

//             if (!response.ok || !result.success) {
//                 throw new Error(
//                     result.message || 'Gagal mencari lokasi.'
//                 );
//             }

//             if (!Array.isArray(result.data) || result.data.length === 0) {
//                 message.textContent = 'Lokasi tidak ditemukan.';
//                 return;
//             }

//             result.data.forEach((lokasi) => {
//                 const option = document.createElement('option');

//                 option.value = lokasi.id;
//                 option.textContent = lokasi.label;
//                 option.dataset.postalCode = lokasi.postal_code;

//                 lokasiSelect.appendChild(option);
//             });

//             lokasiSelect.disabled = false;
//             message.textContent = 'Pilih lokasi pengiriman.';

//             if (oldMappingId) {
//                 lokasiSelect.value = oldMappingId;
//                 lokasiSelect.dispatchEvent(new Event('change'));
//             }
//         } catch (error) {
//             message.textContent = error.message;
//         }
//     }

//     lokasiSelect.addEventListener('change', function () {
//         const selected = lokasiSelect.selectedOptions[0];

//         kodePosInput.value =
//             selected && selected.value
//                 ? selected.dataset.postalCode || ''
//                 : '';
//     });

//     kecamatanSelect.addEventListener('change', cariLokasi);

//     if (kecamatanSelect.value) {
//         cariLokasi();
//     }

// });

document.addEventListener('DOMContentLoaded', function () {

    function validateField(input, errorElement, validator) {

        if (!input || !errorElement) {
            return true;
        }

        const value = input.value.trim();
        const message = validator(value);

        input.classList.remove(
            'border-red-400',
            'border-green-400'
        );

        if (message) {
            input.classList.add('border-red-400');
            errorElement.textContent = message;
            errorElement.classList.remove('hidden');

            return false;
        }

        input.classList.add('border-green-400');
        errorElement.textContent = '';
        errorElement.classList.add('hidden');

        return true;

    }

    const namaTokoInput = document.getElementById('nama_toko');
    const namaTokoError = document.getElementById('nama-toko-error');
    const deskripsiInput = document.getElementById('deskripsi');
    const deskripsiError = document.getElementById('deskripsi-error');
    const fotoProfilInput = document.getElementById('foto_profil');
    const fotoProfilError = document.getElementById('foto-profil-error');
    const fotoProfilName = document.getElementById('foto-profil-name');

    const provinsiInput = document.getElementById('provinsi');
    const provinsiError = document.getElementById('provinsi-error');
    const kotaInput = document.getElementById('kota');
    const kotaError = document.getElementById('kota-error');
    const kecamatanInput = document.getElementById('kecamatan');
    const kecamatanError = document.getElementById('kecamatan-error');
    const kodePosInput = document.getElementById('kode_pos');
    const kodePosError = document.getElementById('kode-pos-error');
    const alamatLengkapInput = document.getElementById('alamat_lengkap');
    const alamatLengkapError = document.getElementById('alamat-lengkap-error');
    const noTeleponInput = document.getElementById('no_telepon');
    const noTeleponError = document.getElementById('no-telepon-error');

    const persetujuanInput = document.getElementById('persetujuan');
    const persetujuanError = document.getElementById('persetujuan-error');
    const fotoKtpError = document.getElementById('foto-ktp-error');

    function validateNamaToko() {

        return validateField(
            namaTokoInput,
            namaTokoError,
            function (value) {

                if (!value) {
                    return 'Nama toko tidak boleh kosong!';
                }

                if (value.length < 3) {
                    return 'Nama toko minimal 3 karakter!';
                }

                if (value.length > 100) {
                    return 'Nama toko maksimal 100 karakter!';
                }

                return '';

            }
        );
    }

    function validateDeskripsi() {
        return validateField(
            deskripsiInput,
            deskripsiError,
            function (value) {

                if (!value) {
                    return 'Deskripsi toko tidak boleh kosong!';
                }

                if (value.length < 10) {
                    return 'Deskripsi toko minimal 10 karakter!';
                }

                if (value.length > 500) {
                    return 'Deskripsi toko maksimal 500 karakter!';
                }

                return '';

            }
        );
    }

    function validateFotoProfil() {

        if (!fotoProfilInput || !fotoProfilError) {
            return true;
        }


        if (!fotoProfilInput.files || fotoProfilInput.files.length === 0) {
            fotoProfilError.textContent = 'Foto profil toko wajib diunggah!';
            fotoProfilError.classList.remove('hidden');

            return false;
        }

        const file = fotoProfilInput.files[0];

        const allowedTypes = [
            'image/jpeg',
            'image/png'
        ];

        if (!allowedTypes.includes(file.type)) {
            fotoProfilError.textContent = 'Format foto harus JPG, JPEG, atau PNG!';
            fotoProfilError.classList.remove('hidden');

            return false;
        }

        if (file.size > 2 * 1024 * 1024) {
            fotoProfilError.textContent = 'Ukuran foto profil maksimal 2 MB!';
            fotoProfilError.classList.remove('hidden');

            return false;
        }

        fotoProfilError.textContent = '';
        fotoProfilError.classList.add('hidden');

        return true;

    }

    function validateProvinsi() {
        return validateField(
            provinsiInput,
            provinsiError,
            function (value) {

                if (!value) {
                    return 'Provinsi harus dipilih!';
                }

                return '';

            }
        );
    }

    function validateKota() {
        return validateField(
            kotaInput,
            kotaError,
            function (value) {
    
                if (!value) {
                    return 'Kota / Kabupaten harus dipilih!';
                }

                return '';

            }
        );
    }

    function validateKecamatan() {
        return validateField(
            kecamatanInput,
            kecamatanError,
            function (value) {
    
                if (!value) {
                    return 'Kecamatan harus dipilih!';
                }

                return '';

            }
        );
    }

    function validateKodePos() {
        return validateField(
            kodePosInput,
            kodePosError,
            function (value) {

                if (!value) {
                    return 'Kode pos tidak boleh kosong!';
                }

                if (!/^\d{5}$/.test(value)) {
                    return 'Kode pos harus terdiri dari 5 digit!';
                }

                return '';

            }
        );
    }

    function validateAlamatLengkap() {
        return validateField(
            alamatLengkapInput,
            alamatLengkapError,
            function (value) {

                if (!value) {
                    return 'Alamat lengkap tidak boleh kosong!';
                }

                if (value.length < 10) {
                    return 'Alamat lengkap minimal 10 karakter!';
                }

                if (value.length > 500) {
                    return 'Alamat lengkap maksimal 500 karakter!';
                }

                return '';

            }
        );
    }

    function validateNoTelepon() {

        if (!noTeleponInput || !noTeleponError) {
            return true;
        }

        let value = noTeleponInput.value.replace(/\D/g, '');

        noTeleponInput.value = value;
        noTeleponInput.classList.remove(
            'border-red-400',
            'border-green-400'
        );

        if (!value) {
            noTeleponInput.classList.add('border-red-400');
            noTeleponError.textContent = 'Nomor telepon tidak boleh kosong!';
            noTeleponError.classList.remove('hidden');

            return false;
        }

        if (!value.startsWith('8')) {
            noTeleponInput.classList.add('border-red-400');
            noTeleponError.textContent = 'Nomor telepon harus diawali angka 8!';
            noTeleponError.classList.remove('hidden');

            return false;
        }

        if (value.length < 9 || value.length > 14) {
            noTeleponInput.classList.add('border-red-400');
            noTeleponError.textContent = 'Nomor telepon harus 9-14 digit setelah angka 0!';
            noTeleponError.classList.remove('hidden');
            return false;
        }

        noTeleponInput.classList.add('border-green-400');
        noTeleponError.textContent = '';
        noTeleponError.classList.add('hidden');

        return true;

    }

    function validateFotoKtp() {

        const fotoKtp = document.getElementById('foto_ktp');

        if (!fotoKtp || !fotoKtpError) {
            return true;
        }

        if (!fotoKtp.files || fotoKtp.files.length === 0) {
            fotoKtpError.textContent = 'Foto KTP wajib diunggah!';
            fotoKtpError.classList.remove('hidden');

            return false;
        }

        const file = fotoKtp.files[0];

        const allowedTypes = [
            'image/jpeg',
            'image/png'
        ];

        if (!allowedTypes.includes(file.type)) {
            fotoKtpError.textContent = 'Format foto KTP harus JPG, JPEG, atau PNG!';
            fotoKtpError.classList.remove('hidden');

            return false;
        }

        if (file.size > 2 * 1024 * 1024) {
            fotoKtpError.textContent = 'Ukuran foto KTP maksimal 2 MB!';
            fotoKtpError.classList.remove('hidden');

            return false;
        }

        fotoKtpError.textContent = '';
        fotoKtpError.classList.add('hidden');

        return true;

    }

    function validatePersetujuan() {

        if (!persetujuanInput || !persetujuanError) {
            return true;
        }
        if (!persetujuanInput.checked) {
            persetujuanError.textContent = 'Kamu harus menyetujui syarat dan ketentuan!';
            persetujuanError.classList.remove('hidden');

            return false;
        }

        persetujuanError.textContent = '';
        persetujuanError.classList.add('hidden');

        return true;

    }

    let currentStep = 1;
    const step1 = document.getElementById('form-step-1');
    const step2 = document.getElementById('form-step-2');
    const step3 = document.getElementById('form-step-3');
    const form = document.getElementById('tokoForm');

    const stepCircles = {
        1: document.getElementById('stepCircle1'),
        2: document.getElementById('stepCircle2'),
        3: document.getElementById('stepCircle3'),
    };

    const stepNumbers = {
        1: document.getElementById('stepNumber1'),
        2: document.getElementById('stepNumber2'),
        3: document.getElementById('stepNumber3'),
    };

    const stepSmall = {
        1: document.getElementById('stepSmall1'),
        2: document.getElementById('stepSmall2'),
        3: document.getElementById('stepSmall3'),
    };

    const stepLabels = {
        1: document.getElementById('stepLabel1'),
        2: document.getElementById('stepLabel2'),
        3: document.getElementById('stepLabel3'),
    };

    const stepLine1 = document.getElementById('stepLine1');
    const stepLine2 = document.getElementById('stepLine2');

    function showStep(step) {

        currentStep = step;

        step1.classList.add('hidden');
        step2.classList.add('hidden');
        step3.classList.add('hidden');

        if (step === 1) {
            step1.classList.remove('hidden');
        }

        if (step === 2) {
            step2.classList.remove('hidden');
        }

        if (step === 3) {
            step3.classList.remove('hidden');
        }

        updateStepper(step);

    }

    function updateStepper(activeStep) {

        for (let i = 1; i <= 3; i++) {

            const circle = stepCircles[i];
            const number = stepNumbers[i];
            const small = stepSmall[i];
            const label = stepLabels[i];

            circle.classList.remove(
                'bg-orange-500',
                'text-white',
                'shadow-lg',
                'shadow-orange-200',
                'border-2',
                'border-orange-200',
                'bg-orange-50',
                'text-orange-400'
            );

            small.classList.remove(
                'text-orange-500',
                'text-[#A89588]'
            );

            label.classList.remove(
                'text-[#3B2115]',
                'text-orange-500',
                'text-[#A89588]'
            );

            if (i < activeStep) {

                circle.classList.add(
                    'bg-orange-500',
                    'text-white',
                    'shadow-lg',
                    'shadow-orange-200'
                );

                number.innerHTML =
                    '<i class="fa-solid fa-check text-xs"></i>';

                small.classList.add('text-orange-500');
                label.classList.add('text-orange-500');
            }

            else if (i === activeStep) {

                circle.classList.add(
                    'bg-orange-500',
                    'text-white',
                    'shadow-lg',
                    'shadow-orange-200'
                );
                number.textContent = i;
                small.classList.add('text-orange-500');
                label.classList.add('text-[#3B2115]');

            } else {

                circle.classList.add(
                    'border-2',
                    'border-orange-200',
                    'bg-orange-50',
                    'text-orange-400'
                );

                number.textContent = i;
                small.classList.add('text-[#A89588]');
                label.classList.add('text-[#A89588]');

            }
        }

        if (activeStep >= 2) {
            stepLine1.classList.remove('bg-orange-100');
            stepLine1.classList.add('bg-orange-500');
        } else {
            stepLine1.classList.remove('bg-orange-500');
            stepLine1.classList.add('bg-orange-100');
        }

        if (activeStep >= 3) {
            stepLine2.classList.remove('bg-orange-100');
            stepLine2.classList.add('bg-orange-500');
        } else {
            stepLine2.classList.remove('bg-orange-500');
            stepLine2.classList.add('bg-orange-100');
        }

    }

    const ktpInput = document.getElementById('foto_ktp');
    const ktpFileName = document.getElementById('ktpFileName');

    if (ktpInput && ktpFileName) {

        ktpInput.addEventListener('change', function () {

            if (this.files && this.files.length > 0) {

                const file = this.files[0];

                ktpFileName.textContent = `File dipilih: ${file.name}`;
                ktpFileName.classList.remove('hidden');

            } else {

                ktpFileName.textContent = '';
                ktpFileName.classList.add('hidden');

            }

        });

    }

    const previewImage = document.getElementById('previewImage');
    const defaultStoreIcon = document.getElementById('defaultStoreIcon');
    const previewName = document.getElementById('previewName');
    const previewDescription = document.getElementById('previewDescription');

    const uploadStoreIcon = document.getElementById('uploadStoreIcon');
    const uploadStorePreview = document.getElementById('uploadStorePreview');

    if (fotoProfilInput && uploadStoreIcon && uploadStorePreview) {
        fotoProfilInput.addEventListener('change', function () {

            const file = this.files[0];

            if (!file) {

                uploadStorePreview.src = '';
                uploadStorePreview.classList.add('hidden');
                uploadStoreIcon.classList.remove('hidden');

                if (previewImage) {
                    previewImage.src = '';
                    previewImage.classList.add('hidden');
                }

                if (defaultStoreIcon) {
                    defaultStoreIcon.classList.remove('hidden');
                }

                if (fotoProfilName) {
                    fotoProfilName.textContent = '';
                    fotoProfilName.classList.add('hidden');
                }

                return;

            }

            if (!validateFotoProfil()) {

                this.value = '';
                uploadStorePreview.src = '';
                uploadStorePreview.classList.add('hidden');
                uploadStoreIcon.classList.remove('hidden');

                return;

            }

            const imageUrl = URL.createObjectURL(file);

            uploadStorePreview.src = imageUrl;
            uploadStorePreview.classList.remove('hidden');
            uploadStoreIcon.classList.add('hidden');

            if (previewImage) {
                previewImage.src = imageUrl;
                previewImage.classList.remove('hidden');
            }

            if (defaultStoreIcon) {
                defaultStoreIcon.classList.add('hidden');
            }

            if (fotoProfilName) {
                fotoProfilName.textContent = `File dipilih: ${file.name}`;
                fotoProfilName.classList.remove('hidden');
            }

        });

    }

    if (namaTokoInput && previewName) {
        namaTokoInput.addEventListener('input', function () {
            const value = this.value.trim();
            previewName.textContent = value || 'Nama Toko';
        });
    }

    if (deskripsiInput && previewDescription) {
        deskripsiInput.addEventListener('input', function () {
            const value = this.value.trim();
            previewDescription.textContent = value || 'Deskripsi toko akan tampil di sini';
        });
    }

    showStep(1);

    function validateStep1() {

        const namaValid = validateNamaToko();
        const deskripsiValid = validateDeskripsi();
        const fotoValid = validateFotoProfil();

        return namaValid && deskripsiValid && fotoValid;

    }

    function validateStep2() {

        const provinsiValid = validateProvinsi();
        const kotaValid = validateKota();
        const kecamatanValid = validateKecamatan();
        const kodePosValid = validateKodePos();
        const alamatValid = validateAlamatLengkap();
        const teleponValid = validateNoTelepon();

        return (
            provinsiValid &&
            kotaValid &&
            kecamatanValid &&
            kodePosValid &&
            alamatValid &&
            teleponValid
        );

    }

    function validateStep3() {

        const fotoValid = validateFotoKtp();
        const persetujuanValid = validatePersetujuan();

        return fotoValid && persetujuanValid;

    }

    document.getElementById('nextStep1')
        ?.addEventListener('click', function (event) {
            event.preventDefault();

            if (!validateStep1()) {
                return;
            }

            showStep(2);
        });

    document.getElementById('prevStep2')
        ?.addEventListener('click', function (event) {
            event.preventDefault();

            showStep(1);
        });

    document.getElementById('nextStep2')
        ?.addEventListener('click', function (event) {
            event.preventDefault();

            if (!validateStep2()) {
                return;
            }

            showStep(3);
        });

    document.getElementById('prevStep3')
        ?.addEventListener('click', function (event) {
            event.preventDefault();

            showStep(2);
        });

    form?.addEventListener('submit', function (event) {

        const step1Valid = validateStep1();
        const step2Valid = validateStep2();
        const step3Valid = validateStep3();

        if (!step1Valid || !step2Valid || !step3Valid) {
            event.preventDefault();

            if (!step1Valid) {
                showStep(1);
                return;
            }

            if (!step2Valid) {
                showStep(2);
                return;
            }

            if (!step3Valid) {
                showStep(3);
                return;
            }

        }
    });
});