<?php
require_once "autoloader.php";

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: inicioSesion.php');
    exit;
}

$username = $_SESSION['username'];

//Se llama para guardar los logros de cada usuario en la tabla Desbloquea
$connUsuario = new LogrosUsuario;
$dataUsuario = $connUsuario ->guardarDesbloqueos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interfaz Principal</title>
    <!-- Enlaces a archivos css -->
    <link rel="stylesheet" href="./Assets/css/index.css">
    <link href="./Assets/css/boxicon.min.css" rel="stylesheet">
    <!-- Enlaces a los estilos del carrusel -->
    <link rel="stylesheet" href="./Assets/owlcarousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="./Assets/owlcarousel/owl.theme.default.min.css" />
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <!-- Logo de la aplicación -->
                <img src="./Assets/img/logop.png" alt="Logo de la aplicación">
            </div>
            <nav>
                <ul class="menu">
                    <!-- Botón de alertas -->
                    <li><a class="nav-link" href="#"><i class='bx bx-bell bx-sm bx-tada-hover text-primary'></i></a></li>
                    <!-- Botón para cambiar entre temas claro y oscuro -->
                    <li><button class="tema-btn" onclick="toggleTema()">Tema Claro/Oscuro</button></li>
                    <!-- Texto "Hola, Nombre de usuario" -->
                    <li><span>Hola, <?php echo $username; ?></span></li>
                    <!-- Botón de usuario -->
                    <li><button class="usuario-btn"><i class='bx bx-user-circle bx-sm text-primary'></i></button></li>
                    <!-- Botón para salir -->
                    <li><button class="salir-btn">Salir</button></li>
                </ul>
            </nav>
        </header>
        <main>
            <section class="main-content">
                <!-- Elementos para visualizar el saldo y los botones -->
                <div class="saldo-container">
                    <div class="saldo-header">
                        <h3>Mi Saldo</h3>
                        <button class="toggle-saldo" onclick="toggleSaldo()">Ocultar/Mostrar</button>
                    </div>
                    <div class="saldo" id="saldo">
                        <p>Tu saldo total es: <span id="saldo-total">100</span> tokens</p>
                    </div>
                </div>
                <div class="acciones">
                    <button class="transferir">Transferir</button>
                    <button class="comprar">Comprar</button>
                    <button class="intercambiar">Intercambiar</button>
                </div>
            </section>

            <!-- Carrusel -->
            <div class="owl-carousel owl-theme">
                <div class="item-carousel"><img src="./Assets/img/prueba.png" alt="Prueba"></div>
                <div class="item-carousel"><img src="https://seeklogo.com/images/H/hp-logo-EEECF99DCE-seeklogo.com.png" alt="HP"></div>
                <div class="item-carousel"><img src="https://seeklogo.com/images/M/microsoft-office-365-logo-C06AEBE075-seeklogo.com.png" alt="Office 365"></div>
                <div class="item-carousel"><img src="https://seeklogo.com/images/D/dell-logo-49B6BF5FC9-seeklogo.com.png" alt="dell"></div>
                <div class="item-carousel"><img src="https://seeklogo.com/images/L/lenovo-logo-E125AE3250-seeklogo.com.png" alt="Lenovo"></div>
                <div class="item-carousel"><img src="https://seeklogo.com/images/L/linux-logo-3793382FC8-seeklogo.com.png" alt="Linux"></div>
                <div class="item-carousel"><img src="https://seeklogo.com/images/L/logitech-logo-376B7C6FCC-seeklogo.com.png" alt="Logitech"></div>
                <div class="item-carousel"><img src="https://seeklogo.com/images/S/spotify-2015-logo-560E071CB7-seeklogo.com.png" alt="spotify"></div>
            </div>
        </main>
        <footer>
            <div class="footer-container">
                <div class="redes-sociales">
                    <h4>Síguenos en redes sociales</h4>
                    <ul class="social-icons">
                        <li><a href="#"><i class="bx bxl-facebook-square"></i></a></li>
                        <li><a href="#"><i class="bx bxl-twitter-square"></i></a></li>
                        <li><a href="#"><i class="bx bxl-instagram-square"></i></a></li>
                        <li><a href="#"><i class="bx bxl-linkedin-square"></i></a></li>
                    </ul>
                </div>
                <div class="enlaces">
                    <h4>Enlaces útiles</h4>
                    <ul>
                        <li><a href="./Assets/html/TYC.html">Términos y condiciones</a></li>
                        <li><a href="./Assets/html/PP.html">Política de privacidad</a></li>
                        <li><a href="./Assets/html/Contacto.php">Contacto</a></li>
                        <li><a href="./Assets/html/Conocenos.html">Conócenos</a></li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2024 ECOBUDDY. Todos los derechos reservados.</p>
            </div>
        </footer>
    </div>

    <!-- Script para ocultar/mostrar el saldo -->
    <script>
        function toggleSaldo() {
            var saldo = document.getElementById("saldo");
            saldo.classList.toggle("hidden");
        }
        
        // Función para cambiar entre temas claro y oscuro
        function toggleTema() {
            var body = document.body;
            body.classList.toggle("tema-oscuro");
        }
    </script>
    <!-- Scripts del carrusel -->
    <script src="./Assets/js/jquery.min.js"></script>
    <script src="./Assets/owlcarousel/owl.carousel.min.js"></script>
    <script>
      $(document).ready(function () {
        $(".owl-carousel").owlCarousel({
            dots: false,
            loop: true,
            margin: 50,
            /* center: true, */
            autoplay: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            responsive:{
                0: {
                    items:1,
                },
                480: {
                    items:2,
                },
                768: {
                    items:5,
                }
            },  
        });
      });
    </script>
</body>
</html>
