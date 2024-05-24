<?php
require_once "autoloader.php";
$user = new Model();
$security = new Security();
$conn = $security->getConn();
$mail = $security->getUserData();
$imagen = $security->getImage($mail);
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="./Assets/css/prueba.css">
    <title>Prueba Felipe</title>
</head>

<body>
    <div class="container-fluid">
        <header>
            <nav class="navbar navbar-expand-sm mb-4">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <img src="Assets/img/logop.png" style="width: 80px;">

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
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Amigos
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="friends.php">Tus amigos</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="addFriends.php">Añadir amigos</a></li>
                                </ul>
                            </li>
                        </ul>
                        <span class="me-5">Hola, <?= htmlspecialchars($_SESSION['username']); ?></span>
                        <!-- Botón de usuario -->
                        <a href="profile.php" class="btn-floating btn-sm  me-5" style="font-size: 23px;">
                            <i class="fas fa-user"></i>
                        </a>
                        <!-- Botón para generar código QR -->
                        <a href="generarQr.php" class="btn-floating btn-sm text-black me-5" style="font-size: 23px;">
                            <i class="fas fa-qrcode"></i>
                        </a>
                        <!-- Botón para cambiar entre temas claro y oscuro -->
                        <div class="theme-toggle-container me-5">
                            <i class="fas fa-sun"></i>
                            <button id="theme-toggle" class="theme-toggle"></button>
                            <i class="fas fa-moon"></i>
                        </div>
                        <!-- Botón para salir -->
                        <a href="logout.php" class="btn-floating btn-sm text-black" style="font-size: 23px;">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </div>
                </div>
            </nav>
        </header>
        <!--  Script para cambiar entre temas claro y oscuro -->
        <script src="Assets/js/ClaroOscuro.js"></script>
        <div class="row">
            <div class="col-12">
                <section>
                    <article>
                        <div class="row">
                            <div class="col-lg-2  col-md-6 ms-4 ">
                                <aside style="margin-top: 60px">
                                    <img src="<?= $imagen ?>" class="border border-dark rounded-circle bg-light m-2 p-2" width="200px" height="180px"><br>
                                    <?= $user->drawPoints() ?>
                                    <?= $user->drawFriends() ?>
                                </aside>
                            </div>
                            <div class="col-lg-6 col-md-6 offset-1">
                                <h2 class="mb-4 mx-auto ">TU PERFIL</h2>
                                <div class="card cuerpo">
                                    <div class="card-body">
                                        <div class="row justify-content-start mb-3">
                                            <div class="col-md-12">
                                                <?= $user->mostrarUsuario() ?>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <a href="edit.php" class="btn custom-button border border-dark text-dark bg-light" style="width: 150px">Editar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 ms-5">
                                <section>
                                    <article style="margin-top: 60px">
                                        <?= $user->drawUserEventsSmall(); ?>
                                    </article>
                                </section>
                            </div>
                        </div>
            </div>
            </article>
            </section>
        </div>
    </div>

    <footer class="custom-bg text-black">
        <div class="row">
            <div class="col-md-4">
                <img src="Assets/img/logop.png" width="150px">
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
    <script src="Assets/js/saldo.js"></script>
    <script src="Assets/js/events.js"></script>
    <script src="Assets/js/friends.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>