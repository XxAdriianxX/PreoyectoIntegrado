<?php
// Autoloader
require_once "autoloader.php";

// Creamos una instancia de la clase GeneradorQR pasando una instancia de Conexion
$generadorQR = new GeneradorQR(new Conexion());

// Obtener el ID del usuario (si es necesario)
$idUsuario = obtener_id_del_usuario();

// Generar el nombre del archivo QR
$nombreArchivo = "qr_codes/usuario_$idUsuario.png";

// Generar el código QR del usuario
$generadorQR->generarQRUsuario($idUsuario, $nombreArchivo);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Código QR del Usuario</title>
    <!-- Agregar estilos CSS si es necesario -->
</head>
<body>
    <h1>Código QR del Usuario</h1>
    <img src="<?php echo $nombreArchivo; ?>" alt="Código QR del Usuario">
</body>
</html>
