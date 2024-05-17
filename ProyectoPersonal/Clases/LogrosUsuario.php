<?php

class LogrosUsuario extends Conexion {

    // Corregir problema, si entra un usuario sin logros se quedan los del usuario anterior porque no se actulizan
    public function logrosUsuario() {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            $dniUsuario = $_SESSION['DNI'];
    
            $dataBase = $this->getConn();
    
            $puntosUsuarioQuery = "SELECT puntos FROM Usuario WHERE DNI = ?";
            $stmt = mysqli_prepare($dataBase, $puntosUsuarioQuery);
            mysqli_stmt_bind_param($stmt, "s", $dniUsuario);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
    
            if ($result->num_rows > 0) {
                $row = mysqli_fetch_assoc($result);
                $puntos = $row['puntos'];
    
                $logroQuery = "SELECT nombre, imagenes FROM Logros WHERE puntos_necesarios <= ?";
                $stmt = mysqli_prepare($dataBase, $logroQuery);
                mysqli_stmt_bind_param($stmt, "i", $puntos);
                mysqli_stmt_execute($stmt);
                $resultado = mysqli_stmt_get_result($stmt);
    
                if (mysqli_num_rows($resultado) > 0) {
                    $logros = array();
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        $logros[] = [
                            'nombre' => $fila['nombre'],
                            'imagen' => $fila['imagenes']
                        ];
                    }
                    $_SESSION['logros'] = $logros;
                } 
            }
        }
    }

    public function numLogros() {
        $dniUsuario = $_SESSION['DNI'];
        $dataBase = $this->getConn();
        
        $puntosUsuarioQuery = "SELECT puntos FROM Usuario WHERE DNI = ?";
        $stmt = mysqli_prepare($dataBase, $puntosUsuarioQuery);
        mysqli_stmt_bind_param($stmt, "s", $dniUsuario);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            $puntos = $row['puntos'];
    
            switch (true) {
                case $puntos < 200:
                    return 0; 
                case $puntos >= 200 && $puntos < 300:
                    return 1;
                case $puntos >= 300 && $puntos < 400:
                    return 2;
                case $puntos >= 400 && $puntos < 500:
                    return 3;
                case $puntos >= 500 && $puntos < 600:
                    return 4;
                case $puntos >= 600 && $puntos < 700:
                    return 5;
                case $puntos >= 700 && $puntos < 800:
                    return 6;
                case $puntos >= 800 && $puntos < 900:
                    return 7;
                case $puntos >= 900 && $puntos < 1000:
                    return 8;
                default:
                    return 9;
            }
        } else {
            return 0; 
        }
    }
    
}
    

