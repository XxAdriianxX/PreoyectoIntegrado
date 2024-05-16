<?php
class User extends Conexion {

    private function obtenerUsuario($usuario) {
        $dataBase = $this->getConn();
        $consulta = "SELECT * FROM Usuario WHERE username = ?";
        $stmt = $dataBase->prepare($consulta);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
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