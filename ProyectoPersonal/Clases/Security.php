<?php
require_once 'Conexion.php';

class Security extends Conexion {
    
    public function registro($reg) {
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



    public function login($log){
        if (isset($_POST["corr"]) && isset($_POST["con"])) {
            $dataBase = $this->getConn();
    
            $correo = $_POST["corr"];
            $contrasena = $_POST["con"];
    
            $consulta = "SELECT mail, contrasena FROM Usuario WHERE mail = '$correo'";
            $resultado = mysqli_query($dataBase, $consulta);
    
            if (mysqli_num_rows($resultado) > 0) {
                $fila = mysqli_fetch_assoc($resultado);  
                $contrasena_hash = $fila['contrasena']; 
                if (password_verify($contrasena, $contrasena_hash)) { 
                    session_start();
                    $_SESSION['loggedin'] = true;
                    header("Location: index.php");
                    exit;
                } else {
                    echo "Contraseña incorrecta";
                }
            } else {
                echo "El correo no está registrado";
            }
    
        } else {
            echo "Error al conectar con la base de datos";
        }
    }

    public function changePassword($password){
        if (isset($_POST["correo"]) && isset($_POST["contraseña"]))  {
            $dataBase = $this->getConn();
    
            $correo = $_POST["correo"];
            $contraseña = $_POST["contraseña"];
    
            $contraseña_hash = password_hash($contraseña, PASSWORD_DEFAULT);
    
            $change = "UPDATE Usuario SET contrasena = '$contraseña_hash' WHERE mail = '$correo'";
    
            if (mysqli_query($dataBase, $change)) {
                echo "Contraseña Actualizada";
            } else {
                echo "Error al conectar con la base de datos: " . mysqli_error($dataBase);
            }
        }
    }
    
}

