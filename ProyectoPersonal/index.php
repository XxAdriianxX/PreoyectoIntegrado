<?php
require_once "autoloader.php";
session_start(); // Inicia la sesión en la página de inicio

$security = new Security();

// Verifica si el usuario ha iniciado sesión
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $usuario = $_SESSION['usuario'];
} else {
    $usuario = null;
}

// Maneja el inicio de sesión si se envían los datos del formulario
/* if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["correo"]) && isset($_POST["contrasena"])) {
        $correo = $_POST["correo"];
        $contrasena = $_POST["contrasena"];
        $login_result = $security->login($correo, $contrasena);
        if ($login_result !== true) {
            echo $login_result;
        }
    }
} */
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interfaz Principal</title>
    <!-- Enlaces a archivos css -->
    <link rel="stylesheet" href="./Assets/css/index.css">
    <link rel="stylesheet" href="./Assets/css/boxicons.css">
    <link rel="stylesheet" href="./Assets/css/boxicons.min.css">
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
            <!-- Botón para generar código QR -->
            <li><button class="nav-link" onclick="generarQR()"><i class='bx bx-qrcode bx-sm bx-tada-hover text-primary'></i></button></li>
            <!-- Botón para cambiar entre temas claro y oscuro -->
            <li><button class="tema-btn" onclick="toggleTema()"><i class='bx bx-sun bx-sm'></i><i class='bx bx-moon bx-sm'></i></button></li>
            <!-- Texto "Hola, Nombre de usuario" -->
            <li><span>Hola, <?php echo htmlspecialchars($usuario); ?></span></li>
            <!-- Botón de usuario -->
            <li><button class="usuario-btn"><i class='bx bx-user-circle bx-sm text-primary'></i></button></li>
            <!-- Botón para salir -->
            <li><button class="salir-btn" onclick="location.href = 'logout.php';"><i class='bx bx-log-out bx-sm bx-tada-hover text-primary'></i></button></li>
            </li>
        </ul>
    </nav>
    </header>
        <main>
            <section class="main-content">
                <!-- Elementos para visualizar el saldo y los botones -->
                <div class="saldo-container">
                    <div class="saldo-header">
                        <h3>Mi Saldo</h3>
                        <button class="toggle-saldo" onclick="toggleSaldo()">
                            <i id="toggle-icon" class='bx bx-hide bx-sm'></i>
                        </button>
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

            <!-- Título "Próximos eventos" -->
            <h2 class="titulo-eventos">Próximos eventos</h2>

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
                <li><a href="Contacto.php">Contacto</a></li>
                <li><a href="./Assets/html/Conocenos.html">Conócenos</a></li>
            </ul>
        </div>
    </div>
    <div class="copyright">
        <p>&copy; 2024 ECOBUDDY. Todos los derechos reservados.</p>
    </div>
</footer>
</div>

    <!-- Scripts Js-->
    <script>
        // Función para mostrar o ocultar saldo
        function toggleSaldo() {
            var saldo = document.getElementById("saldo");
            saldo.classList.toggle("hidden");
        // Alterna la visibilidad del saldo y cambia el ícono entre abierto y cerrado
            var toggleIcon = document.getElementById('toggle-icon');
                if (saldo.classList.contains('hidden')) {
                    toggleIcon.classList.remove('bx-show');
                    toggleIcon.classList.add('bx-hide');
                } else {
                    toggleIcon.classList.remove('bx-hide');
                    toggleIcon.classList.add('bx-show');
                }
        }
        
        // Función para cambiar entre temas claro y oscuro
        function toggleTema() {
            var body = document.body;
            body.classList.toggle("tema-oscuro");
        }

        function generarQR() {
        // Redirigir a la página para mostrar el QR
        window.location.href = "mostrar_Qr.php";
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













