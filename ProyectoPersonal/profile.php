<?php
require_once "autoloader.php"; 

session_start();

// Verificar si el DNI del usuario está en la sesión
if (isset($_SESSION['DNI'])) {
    // Obtener el DNI del usuario de la sesión
    $dniUsuario = $_SESSION['DNI'];
    $userData = User::getUserData($dniUsuario); 

    // Verificar si el campo 'correo' está definido en $userData
    $correo = isset($userData['correo']) ? $userData['correo'] : "No disponible";

    // Verificar si el campo 'ubicacion' está definido en $userData
    $ubicacion = isset($userData['ubicacion']) ? $userData['ubicacion'] : "No disponible";
} else {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
</head>
<body>
    <h1>Perfil de Usuario</h1>
    <ul>
        <li><strong>Nombre de Usuario:</strong> <?php echo $userData['username']; ?></li>
        <li><strong>Correo:</strong> <?php echo $correo; ?></li>
        <li><strong>DNI:</strong> <?php echo $userData['dni']; ?></li>
        <li><strong>Ubicación:</strong> <?php echo $ubicacion; ?></li>
    </ul>
    <a href="index.php">Volver a la página principal</a>
</body>
</html>

