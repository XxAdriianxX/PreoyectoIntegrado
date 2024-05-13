<?php
require_once 'clases/Autoloader.php';

// Creamos una instancia de la clase GeneradorQR
$generadorQR = new GeneradorQR(new Conexion());

// Consulta para obtener todos los usuarios
$sql = "SELECT Id FROM Usuario";

// Ejecutamos la consulta
$resultado = $generadorQR->getConexion()->query($sql);

// Verificamos si hay resultados
if ($resultado->num_rows > 0) {
    // Recorremos los resultados y generamos el código QR para cada usuario
    while ($fila = $resultado->fetch_assoc()) {
        $idUsuario = $fila['Id'];
        $nombreArchivo = $generadorQR->generarQRUsuario($idUsuario);
        echo "Código QR generado para el usuario $idUsuario: <a href='$nombreArchivo'>Descargar</a><br>";
    }
} else {
    echo "No se encontraron usuarios.";
}
?>


