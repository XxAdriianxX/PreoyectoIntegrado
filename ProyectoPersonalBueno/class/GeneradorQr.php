<?php
require_once 'Assets/vendor/phpQrCode/qrlib.php';
require_once 'Connection.php';
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
        // Ruta relativa desde el directorio actual hasta la carpeta qr_codes
        $ruta = 'Assets/vendor/qr_codes/';
        // Ruta absoluta al directorio qr_codes
        /* $ruta = realpath(__DIR__ . '/../../..') . $rutaRelativa; */

        if (!is_dir($ruta)) {
            mkdir($ruta, 0777, true);
        }

        $nombreArchivo = $ruta . "usuario_$dniUsuario.png";

        if ($this->generarQR($datosQR, $nombreArchivo)) {
            return $nombreArchivo;
        } else {
            return false;
        }
    }
}
?>



