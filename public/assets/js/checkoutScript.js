const radios = document.querySelectorAll('input[name="address"]');
const customForm = document.getElementById('customForm');
const customInputs = customForm.querySelectorAll('input');

radios.forEach(radio => {
    radio.addEventListener('change', ()=>{

        customForm.classList.add('d-none');

        customInputs.forEach(input => {
            input.required = false;
        });

        if (radio.value === 'custom') {
            customForm.classList.remove('d-none');

            customInputs.forEach(input => {
                input.required = true;
            });
        }
    });
});