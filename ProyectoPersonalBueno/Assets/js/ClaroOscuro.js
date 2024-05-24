

// Función para aplicar el tema guardado
function applyTheme(theme) {
    const body = document.body;
    
    if (theme === 'dark') {
        body.classList.add('dark-theme');
        body.classList.remove('light-theme');
    } else {
        body.classList.add('light-theme');
        body.classList.remove('dark-theme');
    }
}

// Al cargar la página, aplicar el tema guardado
document.addEventListener('DOMContentLoaded', () => {
    const savedTheme = localStorage.getItem('theme') || 'light';
    applyTheme(savedTheme);
});

// Al hacer clic en el botón, cambiar el tema y guardar la preferencia
document.getElementById('theme-toggle').addEventListener('click', () => {
    const body = document.body;
    let newTheme;
    
    if (body.classList.contains('light-theme')) {
        newTheme = 'dark';
    } else {
        newTheme = 'light';
    }
    
    applyTheme(newTheme);
    localStorage.setItem('theme', newTheme);
});

