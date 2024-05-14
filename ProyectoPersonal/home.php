<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Prueba Felipe</title>
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

        aside{
            background-image: ;
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
                    <a class="navbar-brand" href="#">
                        <img src="img/ej3/logo.jpg" style="width: 30px;">
                    </a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="#">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Apartado 2</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Apartado 3</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Apartado 4</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
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
        <section>
            <div class="row">
                <div class="col-3">
                    <aside>
                        <h2 style="color:black">AMIGOS</h2>
                    </aside>
                </div>
                <div class="col-9">
                    <div class="row">
                        <h2 class="mb-4 rounded-pill  mx-auto custom-bg" style="width:95%">EVENTOS PRÓXIMOS</h2>
                        <div class="col-lg-6 col-md-6">
                            <div class="card custom-bg  text-center mb-5">
                                <div class="card-body">
                                    <h5 class="card-title"><strong>RECOGIDA DE BASURA</strong></h5>
                                    <p class="card-text"><br>Ubicación: Parque natural de
                                        L'albufera</p>
                                    <div class="row justify-content-start mb-2">
                                        <div class="col-md-6">
                                            <span
                                                class="badge rounded-pill pill-bg border border-dark d-block mb-2">Fecha:
                                                27/03/2024</span>
                                            <span
                                                class="badge rounded-pill pill-bg border border-dark d-block mb-2">Horas:
                                                3</span>
                                        </div>
                                        <div class="col-md-6">
                                            <span
                                                class="badge rounded-pill pill-bg border border-dark d-block mb-2">Hora:
                                                17:00</span>
                                            <span
                                                class="badge rounded-pill pill-bg border border-dark d-block mb-2">Puntos:
                                                10</span>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint laborum porro quod
                                        veniam nemo eum qui voluptatem, eius inventore deleniti, at voluptate
                                        repudiandae aspernatur beatae pariatur cumque ab velit aut!</p>
                                    <a href="#" class="btn custom-button border border-dark text-white">Apuntarse</a>
                                </div>
                                <img src="Assets/img/albufera.jpg" class="card-img-bottom" alt="...">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="card custom-bg  text-center mb-5">
                                <div class="card-body">
                                    <h5 class="card-title"><strong>RECOGIDA DE BASURA</strong></h5>
                                    <p class="card-text"><br>Ubicación: Parque natural de
                                        L'albufera</p>
                                    <div class="row justify-content-start mb-2">
                                        <div class="col-md-6">
                                            <span
                                                class="badge rounded-pill pill-bg border border-dark d-block mb-2">Fecha:
                                                27/03/2024</span>
                                            <span
                                                class="badge rounded-pill pill-bg border border-dark d-block mb-2">Horas:
                                                3</span>
                                        </div>
                                        <div class="col-md-6">
                                            <span
                                                class="badge rounded-pill pill-bg border border-dark d-block mb-2">Hora:
                                                17:00</span>
                                            <span
                                                class="badge rounded-pill pill-bg border border-dark d-block mb-2">Puntos:
                                                10</span>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint laborum porro quod
                                        veniam nemo eum qui voluptatem, eius inventore deleniti, at voluptate
                                        repudiandae aspernatur beatae pariatur cumque ab velit aut!</p>
                                    <a href="#" class="btn custom-button border border-dark text-white">Apuntarse</a>
                                </div>
                                <img src="Assets/img/albufera.jpg" class="card-img-bottom" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <article>
            </article>
        </section>
        <footer></footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>