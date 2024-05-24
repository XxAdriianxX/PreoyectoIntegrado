<?php
class PublicacionesUsurario extends Connection
{

    private function subirImagenLocal()
    {
        $DNI = $_SESSION['dni'];
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

    private function guardarImagenBaseDeDatos($rutaArchivo, $DNI, $comentario)
    {
        $sql = "INSERT INTO Publicacion (contenido, DNI_usuario, fecha_hora, comentario_publicacion) VALUES (?, ?, NOW(), ?)";
    
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("sss", $rutaArchivo, $DNI, $comentario);
            if ($stmt->execute()) {
                return true;
            } else {
                echo "Error: " . $stmt->error;
                return false;
            }
            $stmt->close();
        } 
    }
    

        public function insertarImg()
        {
            $DNI = $_SESSION['dni'];
            $comentario = isset($_POST['comentario_publi']) ? $_POST['comentario_publi'] : '';
            $rutaArchivo = $this->subirImagenLocal();

            if ($rutaArchivo) {
                if ($this->guardarImagenBaseDeDatos($rutaArchivo, $DNI, $comentario)) {
                }
            }
        }



    public function insertarComentario($comentario, $fecha_hora_publicacion, $DNI_usuario_P)
    {
        $data = $this->getConn();
        $DNI = $_SESSION['dni'];
        $username = $_SESSION['username']; 

        $fecha_hora_publicacion = mysqli_real_escape_string($data, $fecha_hora_publicacion);
        $DNI_usuario_P = mysqli_real_escape_string($data, $DNI_usuario_P);
        $comentario = mysqli_real_escape_string($data, $comentario);

        $combinedComment = $username . ": " . $comentario;

        $queryPublication = "SELECT fecha_hora, DNI_usuario FROM Publicacion WHERE fecha_hora = '$fecha_hora_publicacion' AND DNI_usuario = '$DNI_usuario_P'";
        $resultPublication = mysqli_query($data, $queryPublication);

        if (mysqli_num_rows($resultPublication) > 0) {
            $row = mysqli_fetch_assoc($resultPublication);
            $fecha_hora_publicacion = $row['fecha_hora'];
            $DNI_usuario_publicacion = $row['DNI_usuario'];

            $insertComentario = "INSERT INTO Comentario (fecha_hora_publicacion, DNI_usuario_publicacion, DNI_usuario_comentario, fecha_hora, contenido) 
                                 VALUES ('$fecha_hora_publicacion', '$DNI_usuario_publicacion', '$DNI', NOW(), '$combinedComment')";
            $resultComentario = mysqli_query($data, $insertComentario);

            if ($resultComentario) {
                return true;
            } else {
                return false;
            }
        
    }
    return false;
}


//Es la que habia en Publicaicones.php, se ha movido porque daba problemas
    public function procesarComentario(){
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_comment'])) {
            $comentario = $_POST['Comentario'];
            $fecha_hora_publicacion = $_POST['fecha_hora_publicacion'];
            $DNI_usuario_P = $_POST['DNI_usuario_P'];
            return $this->insertarComentario($comentario, $fecha_hora_publicacion, $DNI_usuario_P);
            
        }
        return false;
    }


    public function mostrarComentarios($fecha_hora_publicacion, $DNI_usuario_P)
    {
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
    }

    public function cogerPublicacionesUsuario() {
        $data = $this->getConn();
        $DNI = $_SESSION["dni"];
    
        $stmt = $data->prepare("SELECT * FROM Publicacion WHERE DNI_usuario = ?");
        $stmt->bind_param("s", $DNI); 
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $userPubli[] = $row;
            }
            return $userPubli;
        }
    }
    
    
    public function mostrarPublicacionesUsuario() {
        $datos = $this->cogerPublicacionesUsuario();
        if ($datos && !empty($datos)) {
            $html = '<table border="1">';
            $html .= '<tr>';
            $html .= '<td colspan="3" align="center"><h1>Tus publicaciones</h1></td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<th>Comentario de la publicacion</th><th>Fecha y hora</th><th>Eliminar</th>';
            $html .= '</tr>';
    
            foreach ($datos as $datosTabla) {
                $html .= '<tr>';
                $html .= '<td>' . $datosTabla["comentario_publicacion"] . '</td>';
                $html .= '<td>' . $datosTabla['fecha_hora'] . '</td>';
                $html .= '<td><a href="eliminar.php?contenido=' . $datosTabla['contenido'] . '&fecha_hora=' . $datosTabla['fecha_hora'] .'"><img src="Assets/img/basura.png" width="25"></a></td>';
                $html .= '</tr>';
            }
            $html .= '</table>';
            echo $html; 
        } else {
            echo "No tienes ninguna publicación";
        }
    }

    
    


}



