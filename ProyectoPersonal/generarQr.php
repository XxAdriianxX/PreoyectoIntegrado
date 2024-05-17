<?php
require_once 'autoloader.php';

// Iniciar la sesión si no está iniciada
session_start();

// Verificar si el DNI del usuario está en la sesión
if (isset($_SESSION['DNI'])) {
    // Obtener el DNI del usuario de la sesión
    $dniUsuario = $_SESSION['DNI'];

    // Creamos una instancia de la clase GeneradorQR pasando una instancia de Conexion
    $generadorQR = new GeneradorQR(new Conexion());

    // Generar el código QR del usuario
    $nombreArchivo = $generadorQR->generarQRUsuario($dniUsuario);

    // Verificar si se generó correctamente
    if ($nombreArchivo) {
        // Convertir la ruta absoluta en una ruta relativa para el HTML
        $rutaRelativa = str_replace(realpath(__DIR__ . '/../..'), '', realpath($nombreArchivo));
        // Mostrar el código QR generado si se generó correctamente
        echo "Código QR generado para el usuario $dniUsuario: <img src='$rutaRelativa' alt='Código QR del usuario'>";
    } else {
        // Manejar el caso en que ocurra un error durante la generación del código QR
        echo "Error al generar el código QR.";
    }
} else {
    // Si el DNI del usuario no está en la sesión, terminar el script
    exit;
}
?>






