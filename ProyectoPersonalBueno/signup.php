<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Registro - ECOBUDDY</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body{
            background-image: url("Assets/img/corazon.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh; /*Hace que ocupe el 100% de la pantalla*/
            margin: 0; /* Para asegurar que no haya espacios en blanco alrededor */
            padding: 0; /* Para asegurar que no haya espacios en blanco alrededor */
        }

        .title-container {
            background-color: rgba(255, 255, 255, 0.5); /* Fondo semi-transparente */
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            text-align: center;
            padding: 20px 0; /* Espaciado interno */
        }

        header h1 {
            margin: 0; /* Para eliminar cualquier margen predeterminado */
        }

        .content-container {
            margin-top: 100px; /* Ajuste para que el contenido no se superponga con el título */
        }

    </style>
</head>
<body>
<div class="title-container">
    <header><h1>ECOBUDDY</h1></header>
</div>
<nav></nav>
<section class="content-container">
     <article>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card border border-dark text-center" style="background-color: rgba(255, 255, 255, 0.8);">
                        <div class="card-body">
                            <h2 class="card-title text-center">Registro</h2>
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="mail">Correo Electrónico</label>
                                    <input type="email" class="form-control" id="mail" name="mail" placeholder="Ingrese su correo" required>
                                </div>
                                <div class="form-group">
                                    <label for="userPassword">Contraseña</label>
                                    <input type="password" class="form-control" id="userPassword" name="userPassword" maxlength="16" placeholder="Ingrese su contraseña" required>
                                </div>
                                <div class="form-group">
                                    <label for="userName">Username</label>
                                    <input type="text" class="form-control" id="userName" name="userName" maxlength="15" placeholder="Ingrese tu nombre de Usuario" required>
                                </div>
                                <div class="form-group">
                                    <label for="dni">DNI</label>
                                    <input type="text" class="form-control" id="dni" name="dni" maxlength="9" placeholder="Ingrese su DNI" required >
                                </div>
                                <div class="form-group">
                                    <label for="userLocation">Ubicación</label>
                                    <input type="text" class="form-control" id="userLocation" name="userLocation" placeholder="Ingrese su Ubicación" required >
                                </div>
                                <br>
                                <button type="submit" class="btn btn-success btn-block">Registrarse</button>
                                <br>
                                <br>
                                <p>¿Ya tienes cuenta?</p>
                                <a href="login.php" class="btn btn-sm btn-success ">Iniciar Sesión</a>
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
