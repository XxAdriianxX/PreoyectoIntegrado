<?php
require_once 'Assets/vendor/phpQrCode/qrlib.php';
require_once 'conexion.php';

class GeneradorQR {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function generarQR($datos, $nombreArchivo) {
        $tamaño = 10; // Tamaño del código QR (1-10)
        $nivelCorreccion = 'L'; // Nivel de corrección de errores (L, M, Q, H)

        try {
            QRcode::png($datos, $nombreArchivo, $nivelCorreccion, $tamaño);
            return true;
        } catch (Exception $e) {
            echo "Error al generar el código QR: " . $e->getMessage();
            return false;
        }
    }

    public function generarQRUsuario($dniUsuario) {
        $datosQR = $dniUsuario;
        $rutaRelativa = '/Assets/vendor/qr_codes/';
        $rutaCompleta = realpath(__DIR__ . '/../..') . $rutaRelativa;

        if (!is_dir($rutaCompleta)) {
            mkdir($rutaCompleta, 0777, true);
        }

        $nombreArchivo = $rutaCompleta . "usuario_$dniUsuario.png";

        echo "Ruta completa: $rutaCompleta<br>";
        echo "Nombre del archivo: $nombreArchivo<br>";

        if ($this->generarQR($datosQR, $nombreArchivo)) {
            return $nombreArchivo;
        } else {
            return false;
        }
    }
}
?>







