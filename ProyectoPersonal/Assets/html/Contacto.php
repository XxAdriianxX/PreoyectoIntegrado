<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Contacto - ECOBUDDY</title>
    <link rel="stylesheet" href="../css/Contacto.css">
</head>
<body>
    <header>
        <h1>Formulario de Contacto</h1>
    </header>
    <main>
        <form action="../enviar_correo.php" method="post">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="asunto">Asunto:</label>
                <input type="text" id="asunto" name="asunto" required>
            </div>
            <div class="form-group">
                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" name="mensaje" rows="4" required></textarea>
            </div>
            <button type="submit">Enviar</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 ECOBUDDY. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
