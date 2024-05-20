<?php
require_once "autoloader.php";

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: inicioSesion.php');
    exit;
}

$imgUser = new PublicacionesUsurario();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagen de Logro</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="file"] {
            display: block;
            margin-top: 5px;
        }

        input[type="submit"] {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Imagen de Logro</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="imagen">Selecciona una imagen:</label>
                <input type="file" class="form-control-file" name="imagen" id="imagen">
            </div>
            <input type="submit" value="Subir imagen" name="submit" class="btn btn-primary">
        </form>
        <?php
        $imgUser->insertarImg();
        ?>
    </div>
</body>
</html>
