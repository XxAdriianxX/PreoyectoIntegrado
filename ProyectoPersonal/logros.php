<?php
require_once "autoloader.php";

session_start();

$connUser = new LogrosUsuario;
$connUser->logrosUsuario(); 

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: inicioSesion.php');
    exit;
}

$logros = isset($_SESSION['logros']) ? $_SESSION['logros'] : array(); 

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Mis Logros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha383-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .premio {
            width: 200px;
            height: 200px;
            background-color: #f0f0f0;
            border-radius: 15px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        body {
            background-color: #F5F5DC;
        }

        .border {
            background-color: #3CB371; 
            border-radius: 15px;
            padding: 0;
        }

        .contenedor-premios .col-md-3 {
            margin-bottom: 20px; 
            margin: 10px;
        }

        p, h3 {
            margin-left: 15px;
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
                <?php foreach ($logros as $logro) : ?>
                    <div class="col-md-3">
                        <div class="border rounded p-3 d-flex flex-row">
                            <div class="premio">
                                <!-- Aquí se insertará la imagen -->
                            </div>
                            <div>
                                <h3><?php echo $logro; ?></h3>
                                <p>Descripción del logro</p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </article>
</section>
<footer></footer>
</body>
</html>
