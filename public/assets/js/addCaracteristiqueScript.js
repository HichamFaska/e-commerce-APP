document.getElementById('addCaracteristiqueBtn').addEventListener('click', function() {
    const container = document.getElementById('CaracteristiquesContainer');

    const div = document.createElement('div');
    div.className = 'input-group mt-2';

    const nameInput = document.createElement('input');
    nameInput.type = 'text';
    nameInput.name = 'nameCaractr[]';
    nameInput.className = 'form-control';
    nameInput.placeholder = "nom";
    nameInput.required = true;

    const valueInput = document.createElement('input');
    valueInput.type = 'text';
    valueInput.name = 'valueCaract[]';
    valueInput.className = 'form-control';
    valueInput.placeholder = "value";
    valueInput.required = true;

    const btn = document.createElement('button');
    btn.type = 'button';
    btn.className = 'btn btn-danger text-dark remove-caracteristique';
    btn.innerHTML = "<i class='fa-solid fa-trash'></i>";
    btn.addEventListener('click', () => div.remove());

    div.appendChild(nameInput);
    div.appendChild(valueInput);
    div.appendChild(btn);
    container.appendChild(div);
});

document.querySelectorAll('.remove-caracteristique').forEach(btn => {
    btn.addEventListener('click', function() {
        this.parentElement.remove();
    });
});