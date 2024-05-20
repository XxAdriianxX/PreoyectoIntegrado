<?php
require_once "autoloader.php";

// Directorio donde se almacenarán las imágenes cargadas
$directorio = "uploads/";

// Verifica si el directorio no existe, y si es así, intenta crearlo
if (!file_exists($directorio)) {
    if (!mkdir($directorio, 0755, true)) {
        die("Error al crear el directorio uploads/");
    }
}

// Verifica si se está enviando una publicación con imagen
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagen"])) {
    // Nombre del archivo de la imagen
    $nombreArchivo = basename($_FILES["imagen"]["name"]);
    $rutaArchivo = $directorio . $nombreArchivo;

    // Mueve el archivo cargado al directorio de destino
    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaArchivo)) {
        // Guarda la ruta de la imagen en la base de datos como parte del contenido de la publicación
        $contenido = '<img src="' . $rutaArchivo . '" alt="Imagen de la publicación">';
        // Inserta la publicación en la base de datos con la imagen
        // Aquí debes agregar tu lógica para insertar la publicación en la base de datos
    } else {
        echo "Hubo un error al cargar la imagen.";
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <label for="imagen">Selecciona una imagen:</label>
        <input type="file" name="imagen" id="imagen">
        <input type="submit" value="Subir imagen" name="submit">
    </form>
</body>
</html>
