<?php
require_once "autoloader.php";
session_start();

function eliminarPublicacionUsuario(){
    $conn = new Connection;
    $data = $conn->getConn();

    $DNI = $_SESSION['dni'];
    $cont = $_GET['contenido'];
    $fecha = $_GET['fecha_hora'];

    $stmt = $data->prepare("DELETE FROM Comentario WHERE DNI_usuario_publicacion = ? AND fecha_hora_publicacion = ?");
    $stmt->bind_param("ss", $DNI, $fecha);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
    }
    $stmt->close();

    $stmt = $data->prepare("DELETE FROM Publicacion WHERE DNI_usuario = ? AND contenido = ?");
    $stmt->bind_param("ss", $DNI, $cont);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("location: indexPubli.php");
    } else {
        echo "Error al eliminar la publicación: " . $stmt->error;
    }
    $stmt->close();
}

eliminarPublicacionUsuario();
?>
