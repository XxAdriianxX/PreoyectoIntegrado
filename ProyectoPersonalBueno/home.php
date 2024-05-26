<?php
require_once "autoloader.php";
$security = new Security();
$loginMessage = $security->doLogin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="Assets/css/prueba.css">
    <style>
        .carousel-caption {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
            text-align: center;
            color: #fff;
        }

        .jumbotron-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.5); /* Opacidad de fondo */
            padding: 20px;
            border-radius: 10px;
            color: #000; /* Color de texto */
        }

        .btn-group {
            margin-top: 20px;
        }
    </style>
</head>

<body>
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="Assets/img/jumbotron.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption">
                <div class="jumbotron-container">
                    <h1>Bienvenido a ECOBUDDY</h1>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Iniciar Sesión / Registrarse
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="login.php">Iniciar Sesión</a></li>
                            <li><a class="dropdown-item" href="signup.php">Registrarse</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <img src="Assets/img/charla.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption">
                <div class="jumbotron-container">
                    <h1>Bienvenido a ECOBUDDY</h1>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Iniciar Sesión / Registrarse
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="login.php">Iniciar Sesión</a></li>
                            <li><a class="dropdown-item" href="signup.php">Registrarse</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <img src="Assets/img/plantar.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption">
                <div class="jumbotron-container">
                    <h1>Bienvenido a ECOBUDDY</h1>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Iniciar Sesión / Registrarse
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="login.php">Iniciar Sesión</a></li>
                            <li><a class="dropdown-item" href="signup.php">Registrarse</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


    <footer class="footer text-black mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <img src="Assets/img/logop.png" width="150px">
                </div>
                <div class="col-md-4 text-center social-icons">
                    <ul class="list-unstyled list-inline">
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm" style="font-size: 23px;"><i class="fab fa-facebook"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm" style="font-size: 23px;"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm" style="font-size: 23px;"><i class="fab fa-instagram"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm" style="font-size: 23px;"><i class="fab fa-linkedin"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm" style="font-size: 23px;"><i class="fab fa-youtube"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4>Enlaces útiles</h4>
                    <ul>
                        <li><a href="./Assets/html/TYC.html">Términos y condiciones</a></li>
                        <li><a href="./Assets/html/PP.html">Política de privacidad</a></li>
                        <li><a href="Contacto.php">Contacto</a></li>
                        <li><a href="./Assets/html/Conocenos.html">Conócenos</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="copyright text-center">
            <p>&copy; 2024 ECOBUDDY. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
