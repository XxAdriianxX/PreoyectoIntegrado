<?php

require_once 'conexion.php';

class Security extends Conexion {
    public function registro() {
        if (isset($_POST["corr"]) && isset($_POST["con"]) && isset($_POST["user"]) && isset($_POST["dni"])) {

            $dataBase = $this->getConn();

            $correo = mysqli_real_escape_string($dataBase, $_POST["corr"]);
            $contrasena = mysqli_real_escape_string($dataBase, $_POST["con"]);
            $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
            $user = mysqli_real_escape_string($dataBase, $_POST["user"]);
            $dni = mysqli_real_escape_string($dataBase, $_POST["dni"]);

            // Verificar correo
            $consultaCorreo = "SELECT * FROM Usuario WHERE mail = ?";
            $stmtCorreo = $dataBase->prepare($consultaCorreo);
            $stmtCorreo->bind_param("s", $correo);
            $stmtCorreo->execute();
            $resultadoCorreo = $stmtCorreo->get_result();

            if ($resultadoCorreo->num_rows > 0) {
                echo "El correo ya está registrado";
            } else {
                // Verificar nombre de usuario
                $consultaUsuario = "SELECT * FROM Usuario WHERE username = ?";
                $stmtUsuario = $dataBase->prepare($consultaUsuario);
                $stmtUsuario->bind_param("s", $user);
                $stmtUsuario->execute();
                $resultadoUsuario = $stmtUsuario->get_result();

                if ($resultadoUsuario->num_rows > 0) {
                    echo "El nombre de usuario ya está registrado";
                } else {
                    // Verificar DNI
                    $consultaDNI = "SELECT * FROM Usuario WHERE DNI = ?";
                    $stmtDNI = $dataBase->prepare($consultaDNI);
                    $stmtDNI->bind_param("s", $dni);
                    $stmtDNI->execute();
                    $resultadoDNI = $stmtDNI->get_result();

                    if ($resultadoDNI->num_rows > 0) {
                        echo "El DNI ya está registrado";
                    } else {
                        $puntos_iniciales = 100;
                        $insertar = "INSERT INTO Usuario (mail, contrasena, username, DNI, puntos) VALUES (?, ?, ?, ?, ?)";
                        $stmtInsertar = $dataBase->prepare($insertar);
                        $stmtInsertar->bind_param("ssssi", $correo, $contrasena_hash, $user, $dni, $puntos_iniciales);

                        if ($stmtInsertar->execute()) {
                            echo "Registro exitoso";
                        } else {
                            echo "Error al conectar con la base de datos: " . $dataBase->error;
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

        $correo = mysqli_real_escape_string($dataBase, $correo);
        $usuario = $this->obtenerUsuarioPorCorreo($correo);

        if (!$usuario) {
            return "El correo no está registrado";
        }

        if (password_verify($contrasena, $usuario['contrasena'])) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['usuario'] = $usuario['username'];
            $_SESSION['DNI'] = $usuario['DNI'];
            $_SESSION['puntos'] = $usuario['puntos'];

            // Verificar si es la primera vez que inicia sesión
            if ($usuario['puntos'] == 100) {
                $_SESSION['showPuntosPopup'] = true;
            }

            return true;
        } else {
            return "Contraseña incorrecta";
        }
    }

    private function obtenerUsuarioPorCorreo($correo) {
        $dataBase = $this->getConn();
        $consulta = "SELECT * FROM Usuario WHERE mail = ?";
        $stmt = $dataBase->prepare($consulta);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    private function obtenerUsuario($usuario) {
        $dataBase = $this->getConn();
        $consulta = "SELECT * FROM Usuario WHERE username = ?";
        $stmt = $dataBase->prepare($consulta);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    public static function validarEmail($email) {
        // Filtrar y validar el correo electrónico
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function validarTexto($texto) {
        // Validar que el texto no esté vacío
        return !empty($texto);
    }
    
    public function mostrarUsuario($usuario){
        $user = $this->obtenerUsuario($usuario);
        if (!$user) {
            echo "No se encontró el usuario.";
            error_log("Error: No se encontró el usuario con DNI $usuario.");
            return;
        }
        error_log("Usuario recuperado: " . print_r($user, true));
        $form = "";
        $form .= "<h3 class='mb-0 me-2 text-nowrap' style='width: 280px;'>Nombre de usuario:</h3>";
        $form .= "<span class='badge rounded-pill bg-light border border-dark flex-grow-1 text-dark text-start fs-6'>". $user['username'] . "</span>";
        $form .= "</div>";
        $form .= "<h3 class='mb-0 me-2 text-nowrap' style='width: 280px;'>Contraseña:</h3>";
        $form .= "<span class='badge rounded-pill bg-light border border-dark flex-grow-1 text-dark text-start fs-6'>". $user['password'] . "</span>";
        $form .= "</div>";
        $form .= "<h3 class='mb-0 me-2 text-nowrap' style='width: 280px;'>E-mail:</h3>";
        $form .= "<span class='badge rounded-pill bg-light border border-dark flex-grow-1 text-dark text-start fs-6'>". $user['mail'] . "</span>";
        $form .= "</div>";
        $form .= "<h3 class='mb-0 me-2 text-nowrap' style='width: 280px;'>DNI:</h3>";
        $form .= "<span class='badge rounded-pill bg-light border border-dark flex-grow-1 text-dark text-start fs-6'>". $user['id'] . "</span>";
        $form .= "</div>";
        $form .= "<h3 class='mb-0 me-2 text-nowrap' style='width: 280px;'>Ubicación:</h3>";
        $form .= "<span class='badge rounded-pill bg-light border border-dark flex-grow-1 text-dark text-start fs-6'>". $user['ubicacion'] . "</span>";
        $form .= "</div>";
        $form .= "<h3 class='mb-0 me-2 text-nowrap' style='width: 280px;'>Puntos:</h3>";
        $form .= "<span class='badge rounded-pill bg-light border border-dark flex-grow-1 text-dark text-start fs-6'>". $user['puntos'] . "</span>";
        $form .= "</div>";
        echo $form;
    }

}
?>