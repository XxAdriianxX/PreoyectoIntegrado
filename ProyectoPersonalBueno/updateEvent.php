<?php
require_once "autoloader.php";
$connection = new Model();
$conn = $connection->getConn();
$security = new Security();
$eventName = isset($_GET['eventName']) ? $_GET['eventName'] : null;
$eventDate = isset($_GET['eventDate']) ? $_GET['eventDate'] : null;
$eventDate = DateTime::createFromFormat('Y-m-d H:i:s', $eventDate)->format('Y-m-d H:i:s');
$event = $connection->getEvent($eventName, $eventDate);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connection->updateEvent($_POST, $eventName, $eventDate);
}


?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="Assets/css/prueba.css">
    <title>Añadir Evento</title>
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
        <script src="Assets/js/ClaroOscuro.js"></script>

        <div class="row">
            <div class="col-2">
                <aside style="margin-top: 60px;">
                    <?= $connection->drawPoints() ?>
                    <?= $connection->drawFriends() ?>
                </aside>
            </div>
            <div class="col-10">
                <section>
                    <article>
                        <div class="row">
                            <div class="col-9 mb-5 mx-auto">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group border m-3 p-3 rounded">
                                        <h4>Actualiza tu evento</h4>
                                        <p>Introduce la información solicitada</p>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="eventName" class="form-label">
                                                        Nombre:</label>
                                                    <input type="text" class="form-control mb-3" id="eventName" name="eventName" value="<?= $event->name ?>">
                                                    <label for="points" class="form-label">
                                                        Puntos por asistir:</label>
                                                    <input type="number" class="form-control" id="points" name="points" value="<?= $event->points ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4 offset-md-2">
                                                <div class="mb-3">
                                                    <label for="date" class="form-label">
                                                        Fecha:</label>
                                                    <input type="datetime-local" class="form-control mb-3" id="date" name="date" value="<?= $event->date ?>">
                                                    <label for="location" class="form-label">
                                                        Ubicación:</label>
                                                    <input type="text" class="form-control" id="location" name="location" value="<?= $event->location ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <label for="description" class="form-label">
                                                    Descripción:</label>
                                                <textarea class="form-control" rows="3" id="description" name="description" placeholder="<?= $event->description ?>"></textarea>
                                                <input type="file" name="imageFile" id="imageFile" value="">
                                            </div>
                                            <div class="col-md-4 offset-md-2 align-self-end">
                                                <button type="submit" class="btn border submit rounded">Actualizar evento</button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </article>
                </section>
            </div>
        </div>
        <footer class="custom-bg text-black">
            <div class="row">
                <div class="col-md-4">
                    <img src="Assets/img/logop.png" class="" width="150px">
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