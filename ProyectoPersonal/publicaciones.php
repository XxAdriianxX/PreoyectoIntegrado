<?php
require_once("autoloader.php");
$con = new Conexion;
$data = $con->getConn();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicaciones</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #2E4053; 
            padding: 20px;
            margin: 0;
            text-align: center;
        }

        .cont1 {
            margin: 15px;
            border-radius: 10px;
            overflow: hidden;
        }

        .cont1 img {
            max-width: 100%;
            border-radius: 10px;
            height: auto; 
        }
    </style>
</head>
<body>
    <header></header>
    <section class="container">
    <div class="row">
    <?php
    $result = mysqli_query($data, 'SELECT contenido FROM Publicacion');
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <div class="col-md-4 text-center">
        <div class="card">
            <img src="<?php echo $row['contenido']; ?>" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">Comentario</h5>
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" id="Comentario" name="Comentario" placeholder="Ingresar Comentario" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success btn-block">Publicar Comentario</button>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

    </section>
    <footer>
    </footer>
</body>
</html>
