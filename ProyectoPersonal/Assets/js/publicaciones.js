document.addEventListener("DOMContentLoaded", function() {
    // Obtener todos los botones de alternar formulario
    const btnsToggleForm = document.querySelectorAll('.btn-toggle-form');
    const btnsToggleComments = document.querySelectorAll('.btn-toggle-comments');

    // Agregar evento clic a cada botón de alternar formulario
    btnsToggleForm.forEach(btn => {
        btn.addEventListener('click', function() {
            // Obtener el formulario asociado a este botón
            const formulario = this.nextElementSibling;

            // Alternar la visibilidad del formulario
            if (formulario.style.display === 'none' || formulario.style.display === '') {
                formulario.style.display = 'block';
                this.textContent = 'Salir';
            } else {
                formulario.style.display = 'none';
                this.textContent = 'Comentar';
            }
        });
    });
    
    // Agregar evento clic a cada botón de alternar comentarios
    btnsToggleComments.forEach(btn => {
        btn.addEventListener('click', function() {
            // Obtener el contenedor de los comentarios asociado a este botón
            const comentarios = this.nextElementSibling;

            // Alternar la visibilidad de los comentarios
            if (comentarios.style.display === 'none' || comentarios.style.display === '') {
                comentarios.style.display = 'block';
                this.textContent = 'Ocultar Comentarios';
            } else {
                comentarios.style.display = 'none';
                this.textContent = 'Mostrar Comentarios';
            }
        });
    });
});
