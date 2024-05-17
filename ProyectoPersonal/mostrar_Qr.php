<?php
require_once "autoloader.php";

// Iniciar la sesión si no está iniciada
session_start();

// Verificar si el DNI del usuario está en la sesión
if (isset($_SESSION['DNI'])) {
    // Obtener el DNI del usuario de la sesión
    $dniUsuario = $_SESSION['DNI'];

    // Definir la ruta relativa del archivo QR generado
    $rutaRelativa = '/Assets/vendor/qr_codes/';
    $nombreArchivo = realpath(__DIR__ . '/../..') . $rutaRelativa . "usuario_$dniUsuario.png";

    // Verificar si el archivo existe
    if (file_exists($nombreArchivo)) {
        // Convertir la ruta absoluta en una ruta relativa para el HTML
        $rutaRelativa = str_replace(realpath(__DIR__ . '/../..'), '', realpath($nombreArchivo));
        // Mostrar el código QR del usuario
        echo '
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Código QR del Usuario</title>
        </head>
        <body>
            <h1>Código QR del Usuario</h1>
            <img src="' . $rutaRelativa . '" alt="Código QR del Usuario">
        </body>
        </html>';
    } else {
        // Si el archivo no existe, mostrar un mensaje de error
        echo "El archivo QR no existe en la ruta $nombreArchivo.";
    }
} else {
    // Si el DNI del usuario no está en la sesión, terminar el script
    exit;
}
?>








