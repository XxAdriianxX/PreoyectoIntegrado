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
    <link rel="stylesheet" href="Assets/css/logros.css">

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
                            <img src="<?php echo $logro['imagen']; ?>" class="card-img-top">
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
<footer></footer>
</body>
</html>

