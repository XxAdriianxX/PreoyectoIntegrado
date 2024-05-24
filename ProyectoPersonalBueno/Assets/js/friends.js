function toggleFriends() {
    var card = document.getElementById("friends");
    card.classList.toggle("hidden");
    // Cambia el ícono del botón entre abierto y cerrado
    var toggleIcon = document.getElementById('toggle-icon-friends');
    if (card.classList.contains('hidden')) {
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    } else {
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    }
}
