<?php
require_once "autoloader.php";
/* session_start();  */ // Inicia la sesión en la página de inicio
$connection = new Model();
$conn = $connection->getConn();
$security = new Security();
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
    <style>
        .custom-bg {
            background-color: #228B22;
        }

        h1 {
            color: #343a40;
            font-size: 2.5rem;
            margin-bottom: 30px;
        }

        .pill-bg {
            background-color: rgba(217, 217, 217, .3);
        }

        .custom-button {
            background-color: rgba(245, 249, 245, 0.7);
        }

        body {
            background-color: #f8f9fa;
        }

        aside {
            height: 100%;
            width: 100%;
            background-image: url(Assets/img/fondo.jpg);
        }

        a {
            text-decoration: none;
            color: white;
        }

        .custom-span {
            background-color: rgba(255, 255, 255, 0.5);
        }

        .card {
            color: black;
            background-color: #fff;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
            margin-bottom: 20px;
        }

        .card:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .card-img-bottom {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #343a40;
        }

        .card-text {
            color: #343a40;
        }

        h1 {
            color: #343a40;
            font-size: 2.5rem;
            margin-bottom: 30px;
        }

        .pill-bg {
            background-color: rgba(217, 217, 217, .3);
        }

        .custom-button {
            background-color: rgba(245, 249, 245, 0.7);
        }

        body {
            background-color: #f8f9fa;
        }
        
            aside {
            height: 1120px;
            width: 100%;
            background-image: url(Assets/img/Foto2Aside.png);
            background-size: cover; 
            background-position: center; 
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
            }

        a {
            text-decoration: none;
            color: white;
        }

        .custom-span {
            background-color: rgba(255, 255, 255, 0.5);
        }

        .card {
            color: black;
            background-color: #fff;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
            margin-bottom: 20px;
        }

        .card:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .card-img-bottom {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #343a40;
        }

        .card-text {
            color: #343a40;
        }

        .container-fluid {
            padding: 0;
        }
        
        footer {
            padding: 20px 0;
        }
    </style>
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
                        <a href="generarQr.php" class="btn-floating btn-sm text-black me-5" style="font-size: 23px;">
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
                <section>
                    <article>
                        <div class="row mx-auto mb-3">
                            <h1 class="mb-4 mx-auto d-flex justify-content-center" style="width:95%;">EVENTOS PRÓXIMOS</h1>
                            <a href="addEvent.php" class="btn btn-light border border-dark rounded-pill mx-auto" style="width:20%">Crear Evento +</a>
                        </div>
                        <div class="row">
                            <?= $connection->drawEventsList(); ?>
                        </div>
                        <div class="row">
                            <a href="addEvent.php" class="btn btn-light border border-dark rounded-pill mx-auto mb-3" style="width:20%">Crear Evento +</a>
                        </div>
                    </article>
                </section>
            </div>
            <div class="col-2">
                <section>
                    <article>
                        <div class="card fondo" style="margin-top: 60px">
                            <div class="card-body">
                                <h2 class="text-dark text-center">Tus eventos: </h2>
                                <?= $connection->drawUserEventsSmall(); ?>
                            </div>
                        </div>
                    </article>
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
    <script src="js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>