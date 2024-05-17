<?php

require_once 'conexion.php';

class GestorCorreo extends Conexion{
    private $destinatario;

    public function __construct($destinatario) {
        $this->destinatario = $destinatario;
    }

    public function enviarCorreo($nombre, $email, $asunto, $mensaje) {
        // Crea el mensaje de correo
        $contenido = "Nombre: $nombre\n";
        $contenido .= "Correo electrónico: $email\n";
        $contenido .= "Asunto: $asunto\n\n";
        $contenido .= "Mensaje:\n$mensaje";

        // Envía el correo
        if (mail($this->destinatario, "Mensaje de contacto", $contenido)) {
            return true;
        } else {
            return false;
        }
    }
}
?>
