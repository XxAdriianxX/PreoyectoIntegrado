<?php
require_once "autoloader.php";
$connection = new Model();
$conn = $connection->getConn();
$security = new Security();

$security->checkLoggedIn();
$imgUser = new PublicacionesUsurario();

//Es necesario porque si no al recargar al pagina se van añadiendo cards y comentarios 
//Se encarga de redirigir a la misma pagina una vez se ha insertado un comentario o una publicacion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_comment'])) {
    $imgUser->procesarComentario();
    header("Location: {$_SERVER['PHP_SELF']}");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $imgUser->insertarImg();
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="">
    <title>Prueba Felipe</title>
    <link rel="stylesheet" href="Assets/css/indexPubli.css">
</head>

<body>
    <div class="container-fluid">
        <header>
            <nav class="navbar navbar-expand-sm navbar-dark custom-bg mb-4">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand border border-light rounded-circle bg-light" href="#">
                        <img src="Assets/img/logop.png" style="width: 60px;">
                    </a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="indexPubli.php">Inicio</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Eventos
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="userEvents.php">Tus eventos</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="events.php">Todos</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="premios.php">Premios</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="friends.php">Amigos</a>
                            </li>
                        </ul>
                        <span class="me-5">Hola, <?= htmlspecialchars($_SESSION['username']); ?></span>
                        <a href="profile.php" class="btn-floating btn-sm  me-5" style="font-size: 23px;">
                            <i class="fas fa-user"></i>
                        </a>
                        <a href="profile.php" class="btn-floating btn-sm text-black me-5" style="font-size: 23px;">
                            <i class="fas fa-qrcode"></i>
                        </a>
                        <form class="d-flex">
                            <input class="form-control me-2 rounded-pill" type="search" placeholder="Buscar" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                        <a href="logout.php" class="btn-floating btn-sm text-black" style="font-size: 23px;">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </div>
                </div>
            </nav>
        </header>
        <div class="row">
            <div class="col-2">
                <aside>
                    <h5 class=" text-light mx-auto text-center">Puntos:<h5>
                            <span class="custom-span badge rounded-pill border border-dark flex-grow-1 text-dark mb-2 d-flex justify-content-center"><?= $connection->getPoints(); ?></span>
                            <h5 class=" text-light mx-auto text-center">Amigos:<h5>
                                    <?= $connection->drawFriends(); ?>
                </aside>
            </div>
            <div class="col-8">
            <section class="main-content container">
                <article class="text-center my-4 mx-auto">
                    <button class="btn btn-primary btn-toggle-form enlarge-button" style="font-size: 20px;">Subir Publicación</button>
                    <div id="insertPubli" style="display:none;">
                        <h1>Subir Publicación</h1>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="imagen">Selecciona una imagen:</label>
                                <input type="file" class="form-control-file" name="imagen" id="imagen">
                                <br>
                                <label for="comentario_publi">Comentario de la Publicación</label>
                                <textarea class="form-control" name="comentario_publi" rows="3" required></textarea>
                                <br>
                            </div>
                            <input type="submit" value="Subir imagen" name="submit" class="btn btn-primary">
                        </form>

                    </div>
                </article>
            <div class="row">
                <?php
                $result = mysqli_query($conn, 'SELECT contenido, fecha_hora, DNI_usuario, comentario_publicacion FROM Publicacion');
                while ($row = mysqli_fetch_assoc($result)) {
                    $fecha_hora_publicacion = $row['fecha_hora'];
                    $DNI_usuario_P = $row['DNI_usuario'];
                ?>
                <div class="col-md-4 text-center">
                    <div class="card">
                        <img src="<?php echo $row['contenido']; ?>" class="card-img-top">
                        <div class="card-body">
                        <?php echo $row['comentario_publicacion']; ?>
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
                            
                            <!-- Botón para mostrar/ocultar comentarios -->
                            <button class="btn btn-primary btn-toggle-comments">Mostrar Comentarios</button>
                            
                            <div class="comentarios">
                                <?php
                                    $comentarios = $imgUser->mostrarComentarios($fecha_hora_publicacion, $DNI_usuario_P);
                                    if (!empty($comentarios)) {
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
        </div>
        </div>
        <footer class="custom-bg text-black">
            <div class="row">
                <div class="col-md-4">
                    <img src="Assets/img/logop.png" class="border border-light rounded-circle bg-light m-2 p-2" width="150px">
                </div>
                <div class="col-md-4 text-center social-icons">
                    <ul class="list-unstyled list-inline">
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-black" style="font-size: 23px;"><i class="fab fa-facebook"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-black" style="font-size: 23px;"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-black" style="font-size: 23px;"><i class="fab fa-instagram"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-black" style="font-size: 23px;"><i class="fab fa-linkedin"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-black" style="font-size: 23px;"><i class="fab fa-youtube"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-4">
                    <h4>Enlaces útiles</h4>
                    <ul>
                        <li><a href="./Assets/html/TYC.html">Términos y condiciones</a></li>
                        <li><a href="./Assets/html/PP.html">Política de privacidad</a></li>
                        <li><a href="Contacto.php">Contacto</a></li>
                        <li><a href="./Assets/html/Conocenos.html">Conócenos</a></li>
                    </ul>
                </div>
            </div>
            <div class="copyright text-center">
                <p>&copy; 2024 ECOBUDDY. Todos los derechos reservados.</p>
            </div>
        </footer>
    </div>
    <script src="Assets/js/publicaciones.js"></script>
</body>
</html>