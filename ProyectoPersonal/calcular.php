<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Huella de Carbono</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Huella de Carbono</h1>
        <?php
        // Variables para almacenar las respuestas
        $total_emissions = 0;

        // Definir puntos por opción
        $puntos_por_opcion = array(
            "kwh_mensual" => array(0.5, 1, 0.75), 
            "sistema_calefaccion" => array(0.5, 1, 1, 0.75), 
            "km_anuales" => 0.01,
            "consumo_combustible" => 2,
            "frecuencia_transporte_publico" => array(0, 0.5, 1), 
            "tipo_dieta" => array(0.25, 1, 0.5), 
            "frecuencia_carne_lacteos" => array(0.25, 0.5, 1), 
            "origen_alimentos" => array(0.5, 1), 
            "basura_diaria" => 0.25,
            "reciclaje_compostaje" => array(0.5, 0), 
            "consumo_agua" => 0.00025,
            "origen_agua" => array(0.5, 1), 
            "frecuencia_viajes_avion" => array(0, 5, 10), 
            "consumo_bienes_consumo" => 0.05,
            "transporte_trabajo_estudios" => array(2, 1, 0.5),
            "tipo_energia_trabajo_estudios" => array(0.5, 1, 0.75), 
            "otras_actividades_impacto" => array(1, 0) 
        );

        foreach ($_POST as $pregunta => $valor) {
            if (is_array($puntos_por_opcion[$pregunta])) {
                $valor = intval($valor) - 1; 
            }
            if (is_array($puntos_por_opcion[$pregunta])) {
                $total_emissions += $puntos_por_opcion[$pregunta][$valor];
            } else {
                $total_emissions += $puntos_por_opcion[$pregunta] * $valor;
            }
        }

        echo "<div class='alert alert-success' role='alert'>
                La huella de carbono total es: <strong>$total_emissions toneladas de CO2eq.</strong>
            </div>";
        ?>
        <a href="formulario.php" class="btn btn-primary">Volver al formulario</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
