// saldo.js

// Función para mostrar u ocultar saldo
function toggleSaldo() {
    var saldo = document.getElementById("saldo");
    saldo.classList.toggle("hidden");
    // Alterna la visibilidad del saldo y cambia el ícono entre abierto y cerrado
    var toggleIcon = document.getElementById('toggle-icon');
    if (saldo.classList.contains('hidden')) {
        toggleIcon.classList.remove('bx-show');
        toggleIcon.classList.add('bx-hide');
    } else {
        toggleIcon.classList.remove('bx-hide');
        toggleIcon.classList.add('bx-show');
    }
}
