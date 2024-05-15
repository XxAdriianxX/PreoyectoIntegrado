<?php
require_once "autoloader.php";

$sec = new Security();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sec->deleteUser($_POST);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Eliminar Cuenta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body{
            background-image: url("Assets/img/arbol.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh; /*Hace que ocupe el 100% de la pantalla*/
        }

        header {
            display: flex;
            justify-content: center;
            margin-top: 40px;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
<header><h1>ECOBUDDY</h1></header>
<nav></nav>
<section>
    <article>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                <div class="card border border-dark text-center" style="background-color: rgba(255, 255, 255, 0.8);">
                    <div class="card-body">
                    <h2 class="card-title text-center">Eliminar Cuenta</h2>
                    <form action="" method="POST">
                        <div class="form-group">
                        <div class="form-group">
                            <label for="usuario">Usuario</label>
                            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Nombre de usuario" required maxlength="20">
                        </div>
                        <div class="form-group">
                            <label for="contraseña">Contraseña</label>
                            <input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="Ingrese su contraseña" required maxlength="16" minlength="12">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-danger btn-block">Eliminar Cuenta</button>
                        <br>
                        <br>
                        <a href="index.php" class="btn btn-sm btn-success">Volver</a>
                    </form>
                    </div>
                </div>
                </div>
            </div>
            </div>
    </article>
</section>
<footer></footer>
</body>
</html>