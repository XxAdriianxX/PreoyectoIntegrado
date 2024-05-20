<?php
require_once("autoloader.php");
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: inicioSesion.php');
    exit;
}

$con = new Conexion;
$data = $con->getConn();

$imgUser = new PublicacionesUsurario();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicaciones</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #2E4053;
            padding: 20px;
            margin: 0;
            text-align: center;
        }
        .content-wrapper {
            display: flex;
            justify-content: space-between;
        }
        .main-content {
            flex: 1;
        }
        aside {
            width: 300px; /* Ajusta el ancho del aside según sea necesario */
            background-color: #d3d3d3;
            padding: 10px;
            margin-left: 20px; /* Espaciado entre el contenido principal y el aside */
        }
        .card {
            margin-bottom: 20px; 
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,1); 
        }
        .card-img-top {
            border-radius: 10px 10px 0 0; 
        }
        .form-group {
            margin-bottom: 10px; 
        }
        .form-comentario {
            display: none;
        }
        .comentarios {
            display: none;
        }
        .comentario {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <header></header>
    <div class="content-wrapper">
        <section class="main-content container">
            <div class="row">
                <?php
                $result = mysqli_query($data, 'SELECT contenido, fecha_hora, DNI_usuario FROM Publicacion');
                while ($row = mysqli_fetch_assoc($result)) {
                    $fecha_hora_publicacion = $row['fecha_hora'];
                    $DNI_usuario_P = $row['DNI_usuario'];
                ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="<?php echo $row['contenido']; ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Comentarios</h5>
                            <!-- Botón para abrir/cerrar el formulario -->
                            <button class="btn btn-primary btn-toggle-form">Comentar</button>
                            
                            <form action="" method="POST" class="form-comentario">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="Comentario" placeholder="Ingresar Comentario" required>
                                    <input type="hidden" name="fecha_hora_publicacion" value="<?php echo $fecha_hora_publicacion; ?>">
                                    <input type="hidden" name="DNI_usuario_P" value="<?php echo $DNI_usuario_P; ?>">
                                </div>
                                <button type="submit" class="btn btn-success btn-block" name="submit_comment">Publicar Comentario</button>
                            </form>
                            
                            <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_comment'])) {
                                $comentario = $_POST['Comentario'];
                                $fecha_hora_publicacion = $_POST['fecha_hora_publicacion'];
                                $DNI_usuario_P = $_POST['DNI_usuario_P'];

                                $comentUser = $imgUser->insertarComentario($comentario, $fecha_hora_publicacion, $DNI_usuario_P);
                            }
                            ?>
                            
                            <!-- Botón para mostrar/ocultar comentarios -->
                            <button class="btn btn-primary btn-toggle-comments">Mostrar Comentarios</button>
                            
                            <div class="comentarios">
                                <?php
                                    $comentarios = $imgUser->mostrarComentarios($fecha_hora_publicacion, $DNI_usuario_P);
                                    if ($comentarios) {
                                        foreach ($comentarios as $comentario) {
                                            echo "<div class='comentario'>$comentario</div>";
                                        }
                                    } else {
                                        echo "No hay comentarios disponibles.";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </section>
        <aside>
            <div class="container">
                <h1>Subir Publicación</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="imagen">Selecciona una imagen:</label>
                        <input type="file" class="form-control-file" name="imagen" id="imagen">
                    </div>
                    <input type="submit" value="Subir imagen" name="submit" class="btn btn-primary">
                </form>
                <?php
                $imgUser->insertarImg();
                ?>
            </div>
        </aside>
    </div>
    <script src="Assets/js/publicaciones.js"></script>
</body>
<footer>
</footer>
</html>
