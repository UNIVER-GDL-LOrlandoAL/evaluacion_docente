document.addEventListener('DOMContentLoaded', function() {

    const formulario = document.getElementById('formEvaluacion');
    const botonSubmit = document.getElementById('btnSubmit');

    if (formulario && botonSubmit) {

        formulario.addEventListener('submit', function(e) {
            botonSubmit.disabled = true;

            botonSubmit.innerHTML = 'Enviando...';

            botonSubmit.classList.remove('bg-blue-600', 'hover:bg-blue-700');
            botonSubmit.classList.add('bg-gray-400', 'cursor-not-allowed');

        });
    }
});

function toggleComentario(idTextarea, checkbox) {
    const textarea = document.getElementById(idTextarea);

    if (checkbox.checked) {
        // Rellena y bloquear textarea
        textarea.value = 'Sin comentarios';
        textarea.setAttribute('readonly', true);
        textarea.classList.add('bg-gray-200', 'text-gray-500');
    } else {
        // Si lo desmarcan y dice "Sin comentarios", lo limpiamos
        if (textarea.value === 'Sin comentarios') {
            textarea.value = '';
        }
        textarea.removeAttribute('readonly');
        textarea.classList.remove('bg-gray-200', 'text-gray-500');
    }
}
