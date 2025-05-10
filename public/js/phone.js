const whatsappInput = document.getElementById('whatsapp');

whatsappInput.addEventListener('blur', function () {
    let whatsapp = whatsappInput.value.trim();

    whatsapp = whatsapp.replace(/\D/g, '');

    if (whatsapp.startsWith('0')) {
        whatsapp = '62' + whatsapp.substring(1);
    }

    whatsappInput.value = whatsapp;
});
