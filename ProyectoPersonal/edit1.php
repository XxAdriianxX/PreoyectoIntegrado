<?php
require_once "autoloader.php";

$connection = new Connection();
$conn = $connection->getConn();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Introduce la Contraseña</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #D9D9D9;
            background-size: cover;   /* Ajusta el tamaño de la imagen para cubrir todo el contenedor */
            background-repeat: no-repeat;  /* Evita que la imagen se repita */
            background-position: center center; /* Centra la imagen en el contenedor */
            background-attachment: fixed; /* Hace que la imagen de fondo se quede fija al hacer scroll */
            margin: 0; /* Elimina el margen por defecto del cuerpo */
        }

        .form-container {
            background-color: #0E2D40;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: white;
    
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-custom {
            background-color: #D9D9D9;
            color: white;
            font-size: 20px; /* Tamaño del texto del botón */
            padding: 15px 30px; /* Espaciado interno del botón */
            margin: 12px;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        /* Clase específica para el botón de editar */
        .btn-editar {
            font-size: 16px; /* Tamaño del texto específico para el botón "Editar" */
            padding: 10px 20px; /* Espaciado interno específico para el botón "Editar" */
        }
        .card{
            margin-bottom: 400px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <h1>INTRODUCE LA CONTRASEÑA</h1>
            </div>
            <div class="col-lg-6">
                <div class="card text-center mb-5 form-container">
                    <div class="card-body text-center">
                        <form action="" method="post">
                            <div class="mb-3 text-center">
                                <label for="id" class="form-label mx-auto">Contraseña:</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <button class="btn btn-outline-secondary" type="button" id="showPasswordButton">Mostrar</button><br>
                                    <button class="btn-custom btn-outline-secondary" type="submit" id="Send"> <a href="profile.php" class="btn text-success" style="font-size: 20px">Enviar</a></button>

                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript para mostrar/ocultar la contraseña -->
    <script>
        // Función para mostrar/ocultar la contraseña
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('id');
            passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
        }

        // Evento click del botón
        document.getElementById('showPasswordButton').addEventListener('click', togglePasswordVisibility);
    </script>
</body>
</html>