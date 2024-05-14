<?php

require_once 'Conexion.php';

class Security extends Conexion {
    
    public function registro($user) {
        if (isset($_POST["corr"]) && isset($_POST["con"]) && isset($_POST["user"]) && isset($_POST["dni"])) {

            $conn = new Conexion;
            $dataBase = $conn->getConn();

            $correo = $_POST["corr"];
            $contrasena = $_POST["con"];
            $user = $_POST["user"];
            $dni = $_POST["dni"];

            $consulta = "SELECT * FROM Usuario WHERE mail = '$correo'";
            $resultado = mysqli_query($dataBase, $consulta);

            if (mysqli_num_rows($resultado) > 0) {
                echo "El correo ya está registrado";
            } else {
                $insertar = "INSERT INTO Usuario (mail, contrasena, username, DNI) VALUES ('$correo', '$contrasena', '$user', '$dni')";
                if (mysqli_query($dataBase, $insertar)) {
                    echo "Registro exitoso";
                } else {
                    echo "Error al conectar con la base de datos: " . mysqli_error($dataBase);
                }
            }

        } else {
            echo "Error al conectar con la base de datos";
        }
    }

}
?>
