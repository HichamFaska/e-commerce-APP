document.getElementById('addImageBtn').addEventListener('click', function() {
    const container = document.getElementById('imageContainer');

    const div = document.createElement('div');
    div.className = 'input-group mt-2';

    const input = document.createElement('input');
    input.type = 'file';
    input.name = 'images[]';
    input.className = 'form-control';
    input.required = true;

    const btn = document.createElement('button');
    btn.type = 'button';
    btn.className = 'btn btn-danger text-dark remove-image';
    btn.innerHTML = "<i class='fa-solid fa-trash'></i>";
    btn.addEventListener('click', () => div.remove());

    div.appendChild(input);
    div.appendChild(btn);
    container.appendChild(div);
});

document.querySelectorAll('.remove-image').forEach(btn => {
    btn.addEventListener('click', function() {
        this.parentElement.remove();
    });
});