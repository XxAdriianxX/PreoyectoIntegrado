<?php
require_once "autoloader.php";

function imagen() {
    $conn = new Conexion;
    $dataBase = $conn->getConn();

    // Query para obtener la ruta de la imagen del logro "Guardian del Planeta"
    $imgQuery = "SELECT imagenes FROM Logros WHERE nombre = 'Guardian del Planeta'";
    $result = mysqli_query($dataBase, $imgQuery);

    if ($result && mysqli_num_rows($result) > 0) {
        // Obtener la fila de resultado
        $fila = mysqli_fetch_assoc($result);
        // Obtener la ruta de la imagen
        $rutaImagen = $fila['imagenes'];
        // Devolver la ruta de la imagen
        return $rutaImagen;
    } else {
        // Si no se encuentra la imagen, devolver una ruta de imagen por defecto o null
        return null;
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagen de Logro</title>
</head>
<body>
    <h1>Imagen de Logro</h1>
    <div>
        <?php
        // Obtener la ruta de la imagen
        $rutaImagen = imagen();
        if ($rutaImagen) {
            // Mostrar la imagen si se encuentra la ruta
            echo "<img src='$rutaImagen' alt='Guardian del Planeta'>";
        } else {
            // Mostrar un mensaje de imagen no encontrada si no se encuentra la ruta
            echo "Imagen no encontrada";
        }
        ?>
    </div>
</body>
</html>
