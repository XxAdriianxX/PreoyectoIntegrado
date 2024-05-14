<?php
/*<------------Cambiar---------------------->
$che = new check();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $che->registro($_POST);
}
//<---------------------------------------->*/

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Registro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body{
            background-image: url("img/arbol.jpg");
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
<header><h1>ECOBYDDY</h1></header>
<nav></nav>
<section>
     <article>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card border border-dark text-center" style="background-color: rgba(255, 255, 255, 0.8);">
                        <div class="card-body">
                            <h2 class="card-title text-center">Registro</h2>
                            <form action="inicioSesion.php" method="POST">
                                <div class="form-group">
                                    <label for="correo">Correo Electrónico</label>
                                    <input type="email" class="form-control" id="correo" name="correo" placeholder="Ingrese su correo" required>
                                </div>
                                <div class="form-group">
                                    <label for="contrasena">Contraseña</label>
                                    <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Ingrese su contraseña" required>
                                </div>
                                <div class="form-group">
                                    <label for="dni">DNI</label>
                                    <input type="text" class="form-control" id="dni" name="dni" placeholder="Ingrese su DNI" required>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-success btn-block">Registrarse</button>
                                <br>
                                <br>
                                <p>¿Ya tienes cuenta?</p>
                                <a href="inicioSesion.php" class="btn btn-sm btn-success ">Iniciar Sesión</a>
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