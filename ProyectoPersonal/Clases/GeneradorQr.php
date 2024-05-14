<?php
require_once 'Assets/vendor/phpQrCode/qrlib.php';
require_once 'conexion.php';

class GeneradorQR{
    public function generarQR($datos, $nombreArchivo) {
        // Tamaño del código QR
        $tamaño = 10; // Tamaño del código QR (1-10)
        $nivelCorreccion = 'L'; // Nivel de corrección de errores (L, M, Q, H)

        // Genera el código QR y lo guarda en un archivo
        QRcode::png($datos, $nombreArchivo, $nivelCorreccion, $tamaño);
    }

    public function generarQRUsuario($dniUsuario) {
        // Datos que quieres codificar en el código QR (puede ser el ID del usuario, su nombre, etc.)
        $datosQR = "https://tusitioweb.com/perfil.php?id=$dniUsuario";

        // Nombre del archivo donde se guardará el código QR
        $nombreArchivo = "qr_codes/usuario_$dniUsuario.png";

        // Genera el código QR y lo guarda en un archivo
        $this->generarQR($datosQR, $nombreArchivo);

        // Devuelve el nombre del archivo generado
        return $nombreArchivo;
    }
    // Función para obtener el DNI del usuario autenticado
    private function obtener_DNI_del_usuario() {
    // Iniciar la sesión si no está iniciada
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Verificar si el usuario está autenticado y registrado
    if (isset($_SESSION['DNI'])) {
        // Devolver el DNI del usuario autenticado
        return $_SESSION['DNI'];
    } else {
        // Si el usuario no está autenticado, redirigirlo a la página de inicio de sesión
        header("Location: login.php");
        exit; // Finalizar el script después de redirigir
    }
}


}
?>
