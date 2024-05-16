<?php

class LogrosUsuario extends Conexion {
    

    /*
    public function logrosUsuario() {
        $dataBase = $this->getConn();
    
        $puntosUsuario = "SELECT puntos FROM Usuario WHERE DNI = '$dniUsuario'";
        $resultUsuario = mysqli_query($dataBase, $puntosUsuario);
    
        if (mysqli_num_rows($resultUsuario) > 0) {
            $filaUsuario = mysqli_fetch_assoc($resultUsuario);
            $_SESSION['puntos'] = $filaUsuario['puntos']; 
        } else {
            $_SESSION['puntos'] = 0; 
        }
    
        $logro = "SELECT nombre FROM Logros WHERE puntos_necesarios <= ".$_SESSION['puntos'];
        $resultado = mysqli_query($dataBase, $logro);
        
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $datos = array(); 
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $datos[] = $fila;
            }
            $_SESSION['logros'] = $datos; 
        }
        
    }
    */

    public function logrosUsuario() {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            $dniUsuario = $_SESSION['DNI'];
    
            $dataBase = $this->getConn();
    
            $puntosUsuarioQuery = "SELECT puntos FROM Usuario WHERE DNI = ?";
            $stmt = mysqli_prepare($dataBase, $puntosUsuarioQuery);
            mysqli_stmt_bind_param($stmt, "s", $dniUsuario);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
    
            if ($result && $result->num_rows > 0) {
                $row = mysqli_fetch_assoc($result);
                $puntos = $row['puntos'];
    
                $logroQuery = "SELECT nombre FROM Logros WHERE puntos_necesarios <= ?";
                $stmt = mysqli_prepare($dataBase, $logroQuery);
                mysqli_stmt_bind_param($stmt, "i", $puntos);
                mysqli_stmt_execute($stmt);
                $resultado = mysqli_stmt_get_result($stmt);
    
                if ($resultado && mysqli_num_rows($resultado) > 0) {
                    $logros = array();
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        $logros[] = $fila['nombre'];
                    }
                    $_SESSION['logros'] = $logros;
                }
            }
        }
    }
    
    
    
    

    
    
} 
?>
