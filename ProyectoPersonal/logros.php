<?php
require_once "autoloader.php";

session_start();

$connUser = new LogrosUsuario;
$connUser->logrosUsuario(); 

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: inicioSesion.php');
    exit;
}

$logros = $_SESSION['logros'];
//$username = $_SESSION['username'];


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Logros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha383-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
        }

        .contenedor-premios {
            max-width: 800px;
            margin: 0 auto;
        }

        h1 {
            color: #343a40;
            font-size: 2.5rem;
            margin-bottom: 30px;
        }

        .logros-info {
            font-size: 1.2rem;
            color: #6c757d;
            margin-bottom: 50px;
        }

        .logros-info strong {
            color: #28a745;
        }

        .card {
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

        .card-img-top {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1.5rem;
            color: #343a40;
            margin-bottom: 10px;
        }

        .card-text {
            color: #6c757d;
        }
    </style>
</head>
<body>
<header></header>
<nav></nav>
<section>
    <article>
        <div class="container contenedor-premios">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>MIS LOGROS</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center logros-info">
                    Logros desbloqueados: <strong><?php echo $connUser->numLogros(); ?></strong> de 9
                </div>
            </div>

            <div class="row">
                <?php foreach ($logros as $logro) { ?>
                    <div class="col-md-4 text-center">
                        <div class="card">
                            <img src="<?php echo $logro['imagen']; ?>" class="card-img-top" alt="<?php echo $logro['nombre']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $logro['nombre']; ?></h5>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </article>
</section>
<footer>
</footer>
</body>
</html>

