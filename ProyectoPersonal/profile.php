<?php
require_once "autoloader.php";
$user = new Model();
$security = new Security();
$conn = $security->getConn();



/* session_start();
if (isset($_SESSION['dni'])) {
    $dniUsuario = $_SESSION['dni'];
    $userData = User::getUserData($dniUsuario);

    // Verificar si el campo 'correo' está definido en $userData
    $correo = isset($userData['mail']) ? $userData['mail'] : "No disponible";

    // Verificar si el campo 'ubicacion' está definido en $userData
    $ubicacion = isset($userData['userLocation']) ? $userData['userLocation'] : "No disponible";
} else {
    header("Location: login.php");
    exit();
}
 */
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Prueba Felipe</title>
    <style>
        * {
            color: white;
        }

        .custom-bg {
            background-color: #0E2D40;
        }

        .pill-bg {
            background-color: rgba(217, 217, 217, .3);
        }

        .custom-button {
            background-color: #00FF00;
        }

        h2 {
            text-align: center;
        }

        body {
            background-color: #D9D9D9;
        }

        a {
            text-decoration: none;
            color: white;
        }

        .fondo {
            background-image: url(Assets/img/fondo.jpg);
            height: 290px;
            margin-bottom: 20px;
        }

        .custom-span {
            background-color: rgba(255, 255, 255, 0.5);

        }

        .cuerpo {
            background-image: url("Assets/img/fondo2.jpg")
        }

        .form-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .form-group {
            display: flex;
            align-items: center;
        }

        .form-group h3 {
            flex-shrink: 0;
        }

        .form-group span {
            flex-grow: 1;
            border-radius: 1ºxpx;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <header>
            <nav class="navbar navbar-expand-sm navbar-dark custom-bg mb-4">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand border border-light rounded-circle bg-light" href="#">
                        <img src="Assets/img/logop.png" style="width: 60px;">
                    </a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="events.php">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="events.php">Eventos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Premios</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="friends.php">Amigos</a>
                            </li>
                        </ul>
                        <span class="me-5">Hola, <?= htmlspecialchars($_SESSION['username']); ?></span>
                        <a href="profile.php" class="btn-floating btn-sm text-black me-5" style="font-size: 23px;">
                            <i class="fas fa-user"></i>
                        </a>
                        <form class="d-flex">
                            <input class="form-control me-2 rounded-pill" type="search" placeholder="Buscar"
                                aria-label="Search">
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
            <div class="col-12">
                <section>
                    <article>
                        <div class="row">
                            <div class="col-lg-2  col-md-6 ms-4 ">
                                <img src="Assets/img/risa_incontenible.jpg"
                                    class="border border-light rounded-circle bg-light m-2 p-2" width="200px"
                                    height="180px">
                                <div class="card fondo custom-bg">
                                    <div class="card-body">
                                        <h5 class=" text-light">Amigos:<h5>
                                                <?= $user->drawFriends($_SESSION['dni']); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 offset-1">
                                <h2 class="mb-4 rounded-pill  mx-auto custom-bg">TU PERFIL</h2>
                                <div class="card cuerpo">
                                    <div class="card-body">
                                        <div class="row justify-content-start mb-3">
                                            <div class="col-md-12">
                                                <?= $user->showProfile($_SESSION) ?>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <a href="edit1.php"
                                                class="btn custom-button border border-dark text-dark bg-light"
                                                style="width: 150px">Editar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 ms-5">
                                <div class="card fondo custom-bg " style="margin-top: 60px">
                                    <div class="card-body">
                                        <h2>Tus eventos: </h2>
                                        <?= $user->drawUserEvents($_SESSION['dni']); ?>
                                    </div>
                                </div>
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
                <img src="Assets/img/logop.png" class="border border-light rounded-circle bg-light m-2 p-2"
                    width="150px">
            </div>
            <div class="col-md-4 text-center social-icons">
                <ul class="list-unstyled list-inline">
                    <li class="list-inline-item">
                        <a href="#" class="btn-floating btn-sm text-black" style="font-size: 23px;"><i
                                class="fab fa-facebook"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="btn-floating btn-sm text-black" style="font-size: 23px;"><i
                                class="fab fa-twitter"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="btn-floating btn-sm text-black" style="font-size: 23px;"><i
                                class="fab fa-instagram"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="btn-floating btn-sm text-black" style="font-size: 23px;"><i
                                class="fab fa-linkedin"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="btn-floating btn-sm text-black" style="font-size: 23px;"><i
                                class="fab fa-youtube"></i></a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>