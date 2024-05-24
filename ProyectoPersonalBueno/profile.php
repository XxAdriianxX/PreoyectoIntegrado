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
    <style>
        /* Estilos para el cambio de tema claro/oscuro */
body {
    transition: background-color 0.3s, color 0.3s;
}

.light-theme {
    background-color: #ffffff;
    color: #000000;
}

.dark-theme {
    background-color: #656363;
    color: #ffffff;
}

.theme-toggle-container {
    display: flex;
    align-items: center;
    position: relative;
    width: 60px;
}

.theme-toggle-container i {
    font-size: 20px;
    position: absolute;
}

.theme-toggle-container .fa-sun {
    left: 5px;
    color: #f39c12;
}

.theme-toggle-container .fa-moon {
    right: 5px;
    color: #3498db;
}

.theme-toggle {
    position: absolute;
    left: 0;
    right: 0;
    margin: auto;
    background-color: #ffffff;
    border: none;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    cursor: pointer;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    transition: transform 0.3s, background-color 0.3s, box-shadow 0.3s;
}

body.light-theme .theme-toggle {
    transform: translateX(-15px);
    background-color: #ffffff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

body.dark-theme .theme-toggle {
    transform: translateX(15px);
    background-color: #000000;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

/* Estilos para el saldo */
.saldo-container {
    margin-top: 20px;
    text-align: center;
}

.saldo-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.saldo {
    transition: max-height 0.3s, opacity 0.3s;
    max-height: 200px;
    opacity: 1;
    overflow: hidden;
}

.saldo.hidden {
    max-height: 0;
    opacity: 0;
}

/* Estilos para el logo */
header img {
    max-width: 100px;
    transition: filter 0.3s ease; /* Transición suave para el cambio de color */
}

.light-theme header img {
    filter: invert(0); /* Mantener el color original del logo en modo claro */
}

.dark-theme header img {
    filter: invert(0.9) sepia(1) saturate(5) hue-rotate(90deg) brightness(80%) contrast(120%);
}

footer img {
    max-width: 150px;
    transition: filter 0.3s ease; /* Transición suave para el cambio de color */
}

.light-theme footer img {
    filter: invert(0); /* Mantener el color original del logo en modo claro */
}

.dark-theme footer img {
    filter: invert(0.9) sepia(1) saturate(5) hue-rotate(90deg) brightness(80%) contrast(120%);
}

/* Otros estilos generales */

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
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
    transition: box-shadow 0.3s ease-in-out;
    margin-bottom: 20px;
    overflow: hidden;
    transition: transform 0.3s ease-in-out;
}

.card:hover {
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    transform: translateY(-10px);
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

.card-img-top {
    border-radius: 10px 10px 0 0; 
}

.form-group {
    margin-bottom: 10px; 
}

.form-comentario,
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

.enlarge-button {
    font-size: 24px;
    padding: 12px 24px;
    border-radius: 50px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 1);
    background-color: transparent;
    border: 2px solid #007bff; 
    color: #007bff; 
    display: block;
    margin: 0 auto 20px auto; 
}

#insertPubli {
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
    padding: 20px;
    margin-top: 20px;
}

.container-fluid {
    padding: 0;
}

footer {
    padding: 20px 0;
}

h2 {
    text-align: center;
}

/* Navbar */
.navbar {
    margin-bottom: 4rem;
    background-color: #f2f2f2; /* Fondo blanco */
    color: #000000; /* Texto negro por defecto */
    transition: background-color 0.3s, color 0.3s;
}

.navbar-brand {
    border: 2px solid lightgrey;
    border-radius: 50%;
    background-color: #fff;
}

.nav-link {
    color: #000000; /* Texto negro */
}

.nav-link:hover,
.nav-link:focus {
    color: lightgrey;
}

.dropdown-menu {
    background-color: #ffffff; /* Fondo blanco */
    border: none;
}

.dropdown-item {
    color: #000000; /* Texto negro */
}

.dropdown-item:hover,
.dropdown-item:focus {
    background-color: lightgrey;
    color: black;
}

body.dark-theme .navbar,
body.dark-theme .dropdown-menu {
    background-color: #000000; /* Fondo negro */
    color: #ffffff; /* Texto blanco */
}

body.dark-theme .nav-link,
body.dark-theme .dropdown-item {
    color: #ffffff; /* Texto blanco */
}

.me-5 {
    margin-right: 3rem !important;
}

.btn-floating {
    background-color: transparent;
    border: none;
    cursor: pointer;
}

body.light-theme .btn-floating {
    color: #000000; /* Texto negro */
}

body.dark-theme .btn-floating {
    color: #ffffff; /* Texto blanco */
}

.btn-floating:hover,
.btn-floating:focus {
    color: lightgrey;
}

/* Footer */
footer {
    background-color: #f2f2f2; /* Fondo blanco */
    color: #000000; /* Texto negro */
    transition: background-color 0.3s, color 0.3s;
}

body.dark-theme footer {
    background-color: #000000; /* Fondo negro */
    color: #ffffff; /* Texto blanco */
}

footer ul {
    list-style-type: none;
    padding-left: 0;
}

footer ul li {
    margin-bottom: 0.5rem;
}

footer ul li a {
    color: inherit;
    text-decoration: none;
}

footer ul li a:hover,
footer ul li a:focus {
    text-decoration: underline;
}

footer .social-icons .btn-floating {
    margin: 0 0.5rem;
}

.hidden {
    display: none;
}

    </style>
</head>

<body>
    <div class="container-fluid">
        <header>
            <nav class="navbar navbar-expand-sm  mb-4">
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
                            <li class="nav-item">
                                <a class="nav-link" href="friends.php">Amigos</a>
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
                                    <img src="<?= $imagen ?>" class="border border-dark rounded-circle bg-light m-2 p-2" width="200px" height="180px">
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
                                    <article>
                                        <div class="card" style="margin-top: 60px">
                                            <div class="card-body">
                                                <h2 class="text-dark">Tus eventos: </h2>
                                                <?= $user->drawUserEventsSmall(); ?>
                                            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>