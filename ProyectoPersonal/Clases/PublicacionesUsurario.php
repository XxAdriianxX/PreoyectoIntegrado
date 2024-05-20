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


    

}
?>


