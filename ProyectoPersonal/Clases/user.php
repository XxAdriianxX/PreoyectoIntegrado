<?php
require_once "conexion.php"; 

class User {
    public static function getUserData($dni) {
        // Crear una instancia de la clase Conexion para obtener la conexión
        $conexion = new Conexion();
        $conn = $conexion->getConn();

        // Preparar la consulta SQL
        $query = "SELECT username, mail, dni, ubi FROM usuario WHERE dni = ?";
        $statement = $conn->prepare($query);
        $statement->bind_param('s', $dni);

        // Ejecutar la consulta
        $statement->execute();

        // Obtener el resultado
        $result = $statement->get_result();

        // Obtener los datos del usuario como un array asociativo
        $userData = $result->fetch_assoc();

        // Cerrar la declaración
        $statement->close();

        // No es necesario cerrar la conexión aquí

        return $userData;
    }
}
?>

