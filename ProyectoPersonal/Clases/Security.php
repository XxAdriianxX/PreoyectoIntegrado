<?php

require_once 'conexion.php';

class Security extends Conexion {
    public function registro() {
        if (isset($_POST["corr"]) && isset($_POST["con"]) && isset($_POST["user"]) && isset($_POST["dni"])) {

            $dataBase = $this->getConn();

            $correo = $_POST["corr"];
            $contrasena = $_POST["con"];
            $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT); 
            $user = $_POST["user"];
            $dni = $_POST["dni"];

            $consultaCorreo = "SELECT * FROM Usuario WHERE mail = '$correo'";
            $resultadoCorreo = mysqli_query($dataBase, $consultaCorreo);

            if (mysqli_num_rows($resultadoCorreo) > 0) {
                echo "El correo ya está registrado";
            } else {
                $consultaUsuario = "SELECT * FROM Usuario WHERE username = '$user'";
                $resultadoUsuario = mysqli_query($dataBase, $consultaUsuario);

                if (mysqli_num_rows($resultadoUsuario) > 0) {
                    echo "El nombre de usuario ya está registrado";
                } else {
                    $consultaDNI = "SELECT * FROM Usuario WHERE DNI = '$dni'";
                    $resultadoDNI = mysqli_query($dataBase, $consultaDNI);

                    if (mysqli_num_rows($resultadoDNI) > 0) {
                        echo "El DNI ya está registrado";
                    } else {
                        $insertar = "INSERT INTO Usuario (mail, contrasena, username, DNI) VALUES ('$correo', '$contrasena_hash', '$user', '$dni')";
                        if (mysqli_query($dataBase, $insertar)) {
                            echo "Registro exitoso";
                        } else {
                            echo "Error al conectar con la base de datos: " . mysqli_error($dataBase);
                        }
                    }
                }
            }

        } else {
            echo "Error: Todos los campos son requeridos";
        }
    }

    public function login($correo, $contrasena) {
        $dataBase = $this->getConn();

        $usuario = $this->obtenerUsuarioPorCorreo($correo);

        if (!$usuario) {
            return "El correo no está registrado";
        }

        if (password_verify($contrasena, $usuario['contrasena'])) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['usuario'] = $usuario['username'];
            return true;
        } else {
            return "Contraseña incorrecta";
        }
    }

    private function obtenerUsuarioPorCorreo($correo) {
        $dataBase = $this->getConn();
        $consulta = "SELECT * FROM Usuario WHERE mail = '$correo'";
        $resultado = mysqli_query($dataBase, $consulta);
        return mysqli_fetch_assoc($resultado);
    }

    public static function validarEmail($email) {
        // Filtrar y validar el correo electrónico
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    public static function validarTexto($texto) {
        // Validar que el texto no esté vacío
        if (empty($texto)) {
            return false;
        }
        return true;
    }
}
?>
