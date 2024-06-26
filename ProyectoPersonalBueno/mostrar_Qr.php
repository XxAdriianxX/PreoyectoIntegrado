<?php
require_once "autoloader.php";

// Iniciar la sesión si no está iniciada
session_start();

// Verificar si el DNI del usuario está en la sesión
if (isset($_SESSION['dni'])) {
    // Obtener el DNI del usuario de la sesión
    $dniUsuario = $_SESSION['dni'];

    // Definir la ruta completa del archivo QR generado
    $nombreArchivo = "Assets/vendor/qr_codes/usuario_$dniUsuario.png";

    // Verificar si el archivo existe
    if (file_exists($nombreArchivo)) {
        // Mostrar el código QR del usuarios
        echo '
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Código QR del Usuario</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f2f2f2;
                    margin: 0;
                    padding: 0;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                }
                .container {
                    text-align: center;
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                h1 {
                    color: #333;
                }
                img {
                    margin-top: 20px;
                    max-width: 100%;
                    height: auto;
                    border-radius: 10px;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h1>Código QR del Usuario</h1>
                <img src="' . $nombreArchivo . '" alt="Código QR del Usuario">
            </div>
        </body>
        </html>';
    } else {
        // Si el archivo no existe, mostrar un mensaje de error
        echo "El archivo QR no existe.";
    }
} else {
    // Si el DNI del usuario no está en la sesión, terminar el script
    exit;
}
?>





