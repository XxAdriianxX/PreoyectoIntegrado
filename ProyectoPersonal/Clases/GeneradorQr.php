<?php
require_once 'Assets/vendor/phpQrCode/qrlib.php';
require_once 'conexion.php';

class GeneradorQR {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function generarQR($datos, $nombreArchivo) {
        // Tamaño del código QR
        $tamaño = 10; // Tamaño del código QR (1-10)
        $nivelCorreccion = 'L'; // Nivel de corrección de errores (L, M, Q, H)

        try {
            // Genera el código QR y lo guarda en un archivo
            QRcode::png($datos, $nombreArchivo, $nivelCorreccion, $tamaño);
            return true;
        } catch (Exception $e) {
            // Si ocurre un error, muestra un mensaje de error
            echo "Error al generar el código QR: " . $e->getMessage();
            return false;
        }
    }

    public function generarQRUsuario($dniUsuario) {
        // Datos que quieres codificar en el código QR (en este caso, el DNI del usuario)
        $datosQR = $dniUsuario;

        // Ruta absoluta donde se guardará el código QR
        $rutaCompleta = __DIR__ . "/../Assets/vendor/qr_codes/";
        $nombreArchivo = $rutaCompleta . "usuario_$dniUsuario.png";

        // Genera el código QR y verifica si se generó correctamente
        if ($this->generarQR($datosQR, $nombreArchivo)) {
            // Si el código QR se generó correctamente, devuelve el nombre del archivo generado
            return $nombreArchivo;
        } else {
            // Si hubo un error al generar el código QR, devuelve false
            return false;
        }
    }
}
?>



