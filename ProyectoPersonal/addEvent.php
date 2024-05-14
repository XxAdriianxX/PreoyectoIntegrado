<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Añadir Evento Prueba Felipe</title>
    <style>
        * {
            color: white;
        }

        .custom-bg {
            background-color: #228B22;
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
            background-color: #F5F5DC;
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

        form {
            color: black;
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
                                <a class="nav-link" aria-current="page" href="#">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Perfil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Apartado 3</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Apartado 4</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Apartado 5
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Apartado 5 a</a></li>
                                </ul>
                            </li>
                        </ul>
                        <form class="d-flex">
                            <input class="form-control me-2 rounded-pill" type="search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
        </header>
        <div class="row">
            <div class="col-2">
                <aside>
                    <h2 style="color:black">AMIGOS</h2>
                </aside>
            </div>
            <div class="col-10">
                <section>
                    <article>
                        <div class="row">
                            <div class="col-9 mb-5 mx-auto">
                                <form>
                                    <div class="form-group border custom-bg m-3 p-3 rounded">
                                        <h4>Crea un evento</h4>
                                        <p>Introduce la información solicitada</p>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="nombre" class="form-label">
                                                        Nombre:</label>
                                                    <input type="text" class="form-control text-muted" id="nombre" name="nombre" value="Nombre del evento">
                                                </div>
                                            </div>
                                            <div class="col-md-4 offset-2">
                                                <div class="mb-3">
                                                    <label for="fecha" class="form-label">
                                                        Fecha:</label>
                                                    <input type="text" class="form-control text-muted" id="fecha" name="fecha" value="01/01/2024">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="ubicacion" class="form-label">
                                                        Ubicación:</label>
                                                    <input type="text" class="form-control text-muted" id="ubicacion" name="ubicacion" value="Parque Natural de L'Albufera ">
                                                </div>
                                            </div>
                                            <div class="col-md-4 offset-2">
                                                <div class="mb-3">
                                                    <label for="hora" class="form-label">
                                                        Hora:</label>
                                                    <input type="text" class="form-control text-muted" id="hora" name="hora" value="17:00">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <label for="descripcion" class="form-label">
                                                    Deescripción:</label>
                                                <textarea class="form-control text-muted" rows="3" id="descripcion" name="descripcion" placeholder="Describe tu evento"></textarea>
                                            </div>
                                            <div class="col-md-4 offste-2 align-self-end">
                                                <button type="submit" class="btn border submit text-white rounded">Crear evento</button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>