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

    public function generarQRUsuario($idUsuario) {
        // Datos que quieres codificar en el código QR (puede ser el ID del usuario, su nombre, etc.)
        $datosQR = "https://tusitioweb.com/perfil.php?id=$idUsuario";

        // Nombre del archivo donde se guardará el código QR
        $nombreArchivo = "qr_codes/usuario_$idUsuario.png";

        // Genera el código QR y lo guarda en un archivo
        $this->generarQR($datosQR, $nombreArchivo);

        // Devuelve el nombre del archivo generado
        return $nombreArchivo;
    }
}
?>
