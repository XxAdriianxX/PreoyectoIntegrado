<?php
class Security extends Conexion {
    
    public function registro($reg) {
        if (isset($_POST["corr"], $_POST["con"], $_POST["user"], $_POST["dni"])) {
            $dataBase = $this->getConn();
    
            $correo = $_POST["corr"];
            $contrasena = $_POST["con"];
            $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT); 
            $user = $_POST["user"];
            $dni = $_POST["dni"];
    
            $consultaCorreo = "SELECT * FROM Usuario WHERE mail = ?";
            $stmt = mysqli_prepare($dataBase, $consultaCorreo);
            mysqli_stmt_bind_param($stmt, "s", $correo);
            mysqli_stmt_execute($stmt);
            $resultadoCorreo = mysqli_stmt_get_result($stmt);
    
            if (mysqli_num_rows($resultadoCorreo) > 0) {
                echo "El correo ya está registrado";
            } else {
                $consultaUsuario = "SELECT * FROM Usuario WHERE username = ?";
                $stmt = mysqli_prepare($dataBase, $consultaUsuario);
                mysqli_stmt_bind_param($stmt, "s", $user);
                mysqli_stmt_execute($stmt);
                $resultadoUsuario = mysqli_stmt_get_result($stmt);
    
                if (mysqli_num_rows($resultadoUsuario) > 0) {
                    echo "El nombre de usuario ya está registrado";
                } else {
                    $consultaDNI = "SELECT * FROM Usuario WHERE DNI = ?";
                    $stmt = mysqli_prepare($dataBase, $consultaDNI);
                    mysqli_stmt_bind_param($stmt, "s", $dni);
                    mysqli_stmt_execute($stmt);
                    $resultadoDNI = mysqli_stmt_get_result($stmt);
    
                    if (mysqli_num_rows($resultadoDNI) > 0) {
                        echo "El DNI ya está registrado";
                    } else {
                        $insertar = "INSERT INTO Usuario (mail, contrasena, username, DNI) VALUES (?, ?, ?, ?)";
                        $stmt = mysqli_prepare($dataBase, $insertar);
                        mysqli_stmt_bind_param($stmt, "ssss", $correo, $contrasena_hash, $user, $dni);
                        
                        if (mysqli_stmt_execute($stmt)) {
                            header("Location: inicioSesion.php");
                            exit; 
                        } else {
                            echo "Error al conectar con la base de datos";
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
    
            $consulta = "SELECT mail, contrasena, username FROM Usuario WHERE mail = ?";
            $stmt = mysqli_prepare($dataBase, $consulta);
            mysqli_stmt_bind_param($stmt, "s", $correo);
            mysqli_stmt_execute($stmt);
            $resultado = mysqli_stmt_get_result($stmt);
    
            if (mysqli_num_rows($resultado) > 0) {
                $fila = mysqli_fetch_assoc($resultado);  
                $contrasena_hash = $fila['contrasena']; 
                if (password_verify($contrasena, $contrasena_hash)) { 
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $fila['username']; 
                    header("Location: index.php");
                    exit;
                } else {
                    echo "Contraseña incorrecta";
                }
            } else {
                echo "El correo no está registrado";
            }
        } else {
            echo "Error: Todos los campos son requeridos";
        }
    }    

    public function changePassword($password) {
        if (isset($_POST["correo"]) && isset($_POST["contraseña"])) {
            $dataBase = $this->getConn();
    
            $correo = $_POST["correo"];
            $contraseña = $_POST["contraseña"];
    
            $contraseña_hash = password_hash($contraseña, PASSWORD_DEFAULT);
    
            $change = "UPDATE Usuario SET contrasena = ? WHERE mail = ?";
            
            $stmt = mysqli_prepare($dataBase, $change);
            mysqli_stmt_bind_param($stmt, "ss", $contraseña_hash, $correo);
            
            if (mysqli_stmt_execute($stmt)) {
                echo "Contraseña Actualizada";
            } else {
                echo "Error al conectar con la base de datos: " . mysqli_error($dataBase);
            }
            
            mysqli_stmt_close($stmt);
        }
    }
    
    
    // Hay que hacer cambios en la base de datos para que funcione (Vista de relaciones en Cascada)
    public function deleteUser($user) {
        if (isset($_POST["usuario"]) && isset($_POST["contraseña"]))  {
    
            $dataBase = $this->getConn();
    
            $usuario = $_POST["usuario"];
            $contraseña = $_POST["contraseña"];
            $contraseña_hash = password_hash($contraseña, PASSWORD_DEFAULT);
    
            $eliminar = $dataBase->prepare("DELETE FROM Usuario WHERE username = ? AND contrasena = ?");
            $eliminar->bind_param("ss", $usuario, $contraseña_hash);
    
            if ($eliminar->execute()) {
                echo "Cuenta Eliminada";
            } else {
                echo "Error al conectar con la base de datos: " . $dataBase->error;
            }
        }
    }

}

