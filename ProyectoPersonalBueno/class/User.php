<?php
require_once "connection.php";

class User
{
    private $dni;
    private $username;
    private $mail;
    private $ubi;
    private $points;
    private $password;
    public static function getUserData($dni)
    {
        // Crear una instancia de la clase Conexion para obtener la conexión
        $conexion = new Connection();
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

    public function mostrarUsuario($usuario)
    {
        $user = $this->getUserData($usuario);
        if (!$user) {
            echo "No se encontró el usuario.";
            error_log("Error: No se encontró el usuario con DNI $usuario.");
            return;
        }
        error_log("Usuario recuperado: " . print_r($user, true));
        $form = "";
        $form .= "<h3 class='mb-0 me-2 text-nowrap' style='width: 280px;'>Nombre de usuario:</h3>";
        $form .= "<span class='badge rounded-pill bg-light border border-dark flex-grow-1 text-dark text-start fs-6'>" . $user['username'] . "</span>";
        $form .= "</div>";
        $form .= "<h3 class='mb-0 me-2 text-nowrap' style='width: 280px;'>Contraseña:</h3>";
        $form .= "<span class='badge rounded-pill bg-light border border-dark flex-grow-1 text-dark text-start fs-6'>" . $user['password'] . "</span>";
        $form .= "</div>";
        $form .= "<h3 class='mb-0 me-2 text-nowrap' style='width: 280px;'>E-mail:</h3>";
        $form .= "<span class='badge rounded-pill bg-light border border-dark flex-grow-1 text-dark text-start fs-6'>" . $user['mail'] . "</span>";
        $form .= "</div>";
        $form .= "<h3 class='mb-0 me-2 text-nowrap' style='width: 280px;'>DNI:</h3>";
        $form .= "<span class='badge rounded-pill bg-light border border-dark flex-grow-1 text-dark text-start fs-6'>" . $user['id'] . "</span>";
        $form .= "</div>";
        $form .= "<h3 class='mb-0 me-2 text-nowrap' style='width: 280px;'>Ubicación:</h3>";
        $form .= "<span class='badge rounded-pill bg-light border border-dark flex-grow-1 text-dark text-start fs-6'>" . $user['ubicacion'] . "</span>";
        $form .= "</div>";
        $form .= "<h3 class='mb-0 me-2 text-nowrap' style='width: 280px;'>Puntos:</h3>";
        $form .= "<span class='badge rounded-pill bg-light border border-dark flex-grow-1 text-dark text-start fs-6'>" . $user['puntos'] . "</span>";
        $form .= "</div>";
        echo $form;
    }
}
?>