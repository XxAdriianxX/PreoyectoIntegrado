<?php
require_once "autoloader.php";
$security = new Security();
$loginMessage = $security->doLogin();

/* if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["mail"]) && isset($_POST["userPassword"])) {
        $correo = $_POST["mail"];
        $contrasena = $_POST["userPassword"];
        $login_result = $security->login($correo, $contrasena);
        if ($login_result === true) {
            header('Location: events.php');
            exit();  
        } else {
            echo $login_result;
        }
    }
} */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Inicio de sesion</title>
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
                    <h2 class="card-title text-center">Inicio de Sesión</h2>
                    <form action="" method="POST">
                        <div class="form-group">
                        <label for="mail">Correo Electrónico</label>
                        <input type="email" class="form-control" id="mail" name="mail" placeholder="Ingrese su correo" required>
                        </div>
                        <div class="form-group">
                        <label for="userPassword">Contraseña</label>
                        <input type="password" class="form-control" id="userPassword" name="userPassword" maxlength="16" placeholder="Ingrese su contraseña" required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-success btn-block">Iniciar Sesión</button>
                        <br>
                        <br>
                        <p>¿No tienes cuenta?</p>
                        <a href="signup.php" class="btn btn-sm btn-success">Registrarse</a>
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
