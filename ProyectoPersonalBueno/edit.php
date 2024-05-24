<?php
require_once "autoloader.php";
$user = new Model();
$security = new Security();
$conn = $security->getConn();
$mail = $security->getUserData();
$hola = $security->getUser($mail);
$imagen = $security->getImage($mail);

// Mover la llamada a changeInfo después de verificar que el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task = $security->changeInfo($_POST, $_FILES);
}
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
        .custom-bg {
            background-color: #228B22;
        }

        .pill-bg {
            background-color: rgba(217, 217, 217, .3);
        }

        .custom-button {
            background-color: rgba(245, 249, 245, 0.7);
        }

        h1 {
            color: #343a40;
            font-size: 2.5rem;
            margin-bottom: 30px;
        }

        h2 {
            text-align: center;
        }

        body {
            background-color: #f8f9fa;
        }

        aside {
            height: 100%;
            width: 100%;
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

        .custom-bg {
            background-color: #228B22;
        }

        .custom-button {
            background-color: #00FF00;
        }


        .fondo {
            background-image: url(Assets/img/fondo.jpg);
            height: 290px;
            margin-bottom: 20px;
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
            border-radius: 1px;
        }

        .container-fluid {
            padding: 0;
        }
        
        footer {
            padding: 20px 0;
            color: white;
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
                                <a class="nav-link" aria-current="page" href="indexPubli.php">Inicio</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
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
                        <a href="generarQr.php" class="btn-floating btn-sm text-black me-5" style="font-size: 23px;">
                            <i class="fas fa-qrcode"></i>
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
                            <div class="col-lg-2 col-md-6 ms-4 ">
                                <img src="<?= $imagen ?>" class="border border-dark rounded-circle bg-light m-2 p-2"
                                    width="200px" height="180px">
                                <div class="card fondo custom-bg">
                                    <div class="card-body">
                                        <h5 class="text-light">Amigos:</h5>
                                        <?= $user->drawFriends(); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 offset-1">
                                <h2 class="mb-4 mx-auto">TU PERFIL</h2>
                                <div class="card cuerpo">
                                    <div class="card-body">
                                        <div class="row justify-content-start mb-3">
                                            <div class="col-md-12">
                                                <form action="" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="username" class="form-label">
                                                            <h3 class='mt-3 me-2 text-nowrap' style='width: 280px;'>
                                                                Nombre de usuario: </h3>
                                                        </label>
                                                        <input type="text" class="form-control rounded-input"
                                                            id="username" name="username"
                                                            value="<?= $hola['username'] ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email" class="form-label">
                                                            <h3 class='mt-3 me-2 text-nowrap' style='width: 280px'>
                                                                Email: </h3>
                                                        </label>
                                                        <input type="email" class="form-control rounded-input"
                                                            id="email" name="email" value="<?= $hola['mail'] ?>"
                                                            required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="dni" class="form-label">
                                                            <h3 class='mt-3 me-2 text-nowrap' style='width: 280px;'>DNI:
                                                            </h3>
                                                        </label>
                                                        <span
                                                            class='badge rounded-pill bg-light border border-dark flex-grow-1 text-dark text-start fs-6'><?= $hola['DNI'] ?></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="ubi" class="form-label">
                                                            <h3 class='mt-3 me-2 text-nowrap' style='width: 280px;'>
                                                                Ubicación: </h3>
                                                        </label>
                                                        <input type="text" class="form-control rounded-input" id="ubi"
                                                            name="ubi" value="<?= $hola['ubi'] ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="imageFile" class="form-label">
                                                            <h3 class='mt-3 me-2 text-nowrap' style='width: 280px;'>
                                                                Foto de perfil: </h3>
                                                        </label>
                                                        <input type="file" name="imageFile" id="imageFile">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="hidden" name="id" value="12028" />
                                                        <input class="button_text" type="submit" name="submit"
                                                            value="Guardar" />
                                                    </div>
                                                </form>
                                            </div>
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
                                        </div>
                                    </article>
                                </section>
                            </div>
                        </div>
                    </article>
                </section>
            </div>
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