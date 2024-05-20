<?php
class PublicacionesUsurario extends Conexion {

    private function usuarioLogueado() {
        return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
    }

    private function subirImagenLocal($DNI) {
        $directorio = "Assets/imgPublicaciones/";

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagen"])) {
            $nombreArchivo = $DNI . '_' . basename($_FILES["imagen"]["name"]);
            $rutaArchivo = $directorio . $nombreArchivo;

            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaArchivo)) {
                return $rutaArchivo; 
            } else {
                echo "Hubo un error al cargar la imagen.";
                return false;
            }
        }
        return false;
    }

    private function guardarImagenBaseDeDatos($rutaArchivo, $DNI) {
        $sql = "INSERT INTO Publicacion (Contenido, DNI_usuario, fecha_hora) VALUES (?, ?, NOW())";
    
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("ss", $rutaArchivo, $DNI);
            if ($stmt->execute()) {
                return true;
            } else {
                echo "Error al guardar la ruta de la imagen en la base de datos.";
                return false;
            }
            $stmt->close();
        }
    }
    

    public function insertarImg() {
        if ($this->usuarioLogueado()) {
            $DNI = $_SESSION['DNI'];
            $rutaArchivo = $this->subirImagenLocal($DNI);

            if ($rutaArchivo) {
                if ($this->guardarImagenBaseDeDatos($rutaArchivo, $DNI)) {
                    echo "Imagen subida y ruta guardada en la base de datos exitosamente.";
                }
            }
        }
    }


    //Hay un error en las claves de la base de datos que hahce que a la hora de insertar de un error, pero los comentarios se insertan igual
        public function insertarComentario($comentario, $fecha_hora_publicacion, $DNI_usuario_P) {
            if ($this->usuarioLogueado()) {
                $data = $this->getConn();
                $DNI = $_SESSION['DNI'];
        
                $fecha_hora_publicacion = mysqli_real_escape_string($data, $fecha_hora_publicacion);
                $DNI_usuario_P = mysqli_real_escape_string($data, $DNI_usuario_P);
                $comentario = mysqli_real_escape_string($data, $comentario);
        
                $queryPublication = "SELECT fecha_hora, DNI_usuario FROM Publicacion WHERE fecha_hora = '$fecha_hora_publicacion' AND DNI_usuario = '$DNI_usuario_P'";
                $resultPublication = mysqli_query($data, $queryPublication);
        
                if (mysqli_num_rows($resultPublication) > 0) {
                    $row = mysqli_fetch_assoc($resultPublication);
                    $fecha_hora_publicacion = $row['fecha_hora'];
                    $DNI_usuario_publicacion = $row['DNI_usuario'];
        
                    $insertComentario = "INSERT INTO Comentario (fecha_hora_publicacion, DNI_usuario_publicacion, DNI_usuario_comentario, fecha_hora, contenido) 
                                         VALUES ('$fecha_hora_publicacion', '$DNI_usuario_publicacion', '$DNI', NOW(), '$comentario')";
                    $resultComentario = mysqli_query($data, $insertComentario);
        
                    if ($resultComentario) {
                        return true;
                    } else {
                        return false;
                    }
                }
            }
            return false;
        }
    
    
    
        public function mostrarComentarios($fecha_hora_publicacion, $DNI_usuario_P) {
            if ($this->usuarioLogueado()) {
                $data = $this->getConn();
        
                $coment = "SELECT contenido FROM Comentario WHERE fecha_hora_publicacion = '$fecha_hora_publicacion' AND DNI_usuario_publicacion = '$DNI_usuario_P'";
                $result = mysqli_query($data, $coment);
        
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $comentarios[] = $row['contenido'];
                    }
                    return $comentarios;
                } else {
                    return null;
                }
            } else {
                return null;
            }
        }
        
        

    

}



