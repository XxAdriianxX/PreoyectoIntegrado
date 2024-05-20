<?php
session_start();

// Autoloader
require_once "autoloader.php";

if (isset($_SESSION['nombre'], $_SESSION['email'], $_SESSION['asunto'], $_SESSION['mensaje'])) {
    // Recoge los datos de la sesión
    $nombre = $_SESSION['nombre'];
    $email = $_SESSION['email'];
    $asunto = $_SESSION['asunto'];
    $mensaje = $_SESSION['mensaje'];

    // Dirección de correo a la que se enviará el mensaje
    $destinatario = "tu_correo@example.com";

    // Crea una instancia de la clase GestorCorreo
    $gestorCorreo = new GestorCorreo($destinatario);

    // Envía el correo
    if ($gestorCorreo->enviarCorreo($nombre, $email, $asunto, $mensaje)) {
        echo "<p>¡El mensaje se ha enviado correctamente!</p>";
    } else {
        echo "<p>¡Hubo un error al enviar el mensaje! Por favor, inténtalo de nuevo más tarde.</p>";
    }

    // Borra los datos de la sesión
    session_unset();
    session_destroy();
} else {
    echo "<p>No se encontraron datos para enviar el correo.</p>";
}
?>

