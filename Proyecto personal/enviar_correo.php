<?php
// Autoloader
require_once "Clases/autoloader.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoge los datos del formulario
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $asunto = $_POST["asunto"];
    $mensaje = $_POST["mensaje"];

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
}
?>
