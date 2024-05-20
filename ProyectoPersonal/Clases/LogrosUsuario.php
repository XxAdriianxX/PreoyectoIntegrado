<?php
class LogrosUsuario extends Conexion {

    public function logrosUsuario() {
        if ($this->usuarioLogueado()) {
            $puntos = $this->obtenerPuntosUsuario();
            if ($puntos !== false) {
                $logros = $this->obtenerLogrosDesbloqueados($puntos);
                if (!empty($logros)) {
                    $_SESSION['logros'] = $logros;
                }
            }
        }
    }
    

    public function numLogros() {
        $puntos = $this->obtenerPuntosUsuario();
        if ($puntos !== false) {
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

    public function guardarDesbloqueos() {
        if ($this->usuarioLogueado()) {
            $puntos = $this->obtenerPuntosUsuario();
            if ($puntos !== false) {
                $logros = $this->obtenerLogrosDesbloqueados($puntos);
                if (!empty($logros)) {
                    $this->insertarLogrosDesbloqueados($logros);
                }
            }
        }
    }

    private function usuarioLogueado() {
        return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
    }

    private function obtenerPuntosUsuario() {
        $dniUsuario = $_SESSION['DNI'];
        $dataBase = $this->getConn();
        $puntosUsuarioQuery = "SELECT puntos FROM Usuario WHERE DNI = ?";
        $stmt = mysqli_prepare($dataBase, $puntosUsuarioQuery);
        mysqli_stmt_bind_param($stmt, "s", $dniUsuario);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row['puntos'];
        } else {
            return false;
        }
    }

    private function obtenerLogrosDesbloqueados($puntos) {
        $dataBase = $this->getConn();
        $logroQuery = "SELECT nombre, imagenes, puntos_necesarios FROM Logros WHERE puntos_necesarios <= ? ORDER BY puntos_necesarios ASC";
        $stmt = mysqli_prepare($dataBase, $logroQuery);
        mysqli_stmt_bind_param($stmt, "i", $puntos);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        $logros = array();
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $logros[] = [
                'nombre' => $fila['nombre'],
                'imagen' => $fila['imagenes'],
            ];
        }
        return $logros;
    }


    //Funcion para insertar los logros desbloqueados de cada Usuario en la tabla Desbloquea
    private function insertarLogrosDesbloqueados($logros) {
        $dniUsuario = $_SESSION['DNI'];
        $dataBase = $this->getConn();
        $insertStatement = mysqli_prepare($dataBase, "INSERT INTO Desbloquea (DNI_usuario, nombre_logro) VALUES (?, ?)");
        mysqli_stmt_bind_param($insertStatement, "ss", $dniUsuario, $nombreLogro);
        foreach ($logros as $logro) {
            $nombreLogro = $logro['nombre'];
            $verificarStatement = mysqli_prepare($dataBase, "SELECT COUNT(*) AS count FROM Desbloquea WHERE DNI_usuario = ? AND nombre_logro = ?");
            mysqli_stmt_bind_param($verificarStatement, "ss", $dniUsuario, $nombreLogro);
            mysqli_stmt_execute($verificarStatement);
            $countResult = mysqli_stmt_get_result($verificarStatement);
            $countRow = mysqli_fetch_assoc($countResult);
            if ($countRow['count'] == 0) {
                mysqli_stmt_execute($insertStatement);
            }
        }
        mysqli_stmt_close($insertStatement);
    }
}

    

