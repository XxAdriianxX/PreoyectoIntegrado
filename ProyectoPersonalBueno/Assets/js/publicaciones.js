//Si hay problemas con el CSS es culpa del JS

document.addEventListener("DOMContentLoaded", function() {
    // Obtener todos los botones de alternar formulario de comentarios
    const btnsToggleCommentForm = document.querySelectorAll('.btn-toggle-comment-form');
    // Obtener todos los botones de alternar formulario de subir publicación
    const btnsToggleUploadForm = document.querySelectorAll('.btn-toggle-upload-form');
    // Obtener todos los botones de alternar comentarios
    const btnsToggleComments = document.querySelectorAll('.btn-toggle-comments');

    // Agregar evento clic a cada botón de alternar formulario de comentarios
    btnsToggleCommentForm.forEach(btn => {
        btn.addEventListener('click', function() {
            // Obtener el formulario de comentario asociado a este botón
            const formularioComentario = this.nextElementSibling;

            // Alternar la visibilidad del formulario de comentario
            if (formularioComentario.style.display === 'none' || formularioComentario.style.display === '') {
                formularioComentario.style.display = 'block';
                this.textContent = 'Salir';
            } else {
                formularioComentario.style.display = 'none';
                this.textContent = 'Comentar'; 
            }
        });
    });

    // Agregar evento clic a cada botón de alternar formulario de subir publicación
    btnsToggleUploadForm.forEach(btn => {
        btn.addEventListener('click', function() {
            // Obtener el formulario de subir publicación asociado a este botón
            const formularioPublicacion = this.nextElementSibling;

            // Alternar la visibilidad del formulario de subir publicación
            if (formularioPublicacion.style.display === 'none' || formularioPublicacion.style.display === '') {
                formularioPublicacion.style.display = 'block';
                this.textContent = 'Salir';
            } else {
                formularioPublicacion.style.display = 'none';
                this.textContent = 'Subir Publicación'; 
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
