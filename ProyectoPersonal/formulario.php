<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Huella de Carbono</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Formulario de Huella de Carbono</h1>
        <form action="calcular.php" method="post">
            <div class="form-group">
                <label for="kwh_mensual">Consumo de electricidad mensual (kWh):</label>
                <input type="number" class="form-control" id="kwh_mensual" name="kwh_mensual">
            </div>
            <div class="form-group">
                <label for="fuente_energia">Fuente de energía en el hogar:</label>
                <select class="form-control" id="fuente_energia" name="fuente_energia">
                    <option value="1">Electricidad</option>
                    <option value="2">Gas natural</option>
                    <option value="3">Otros</option>
                </select>
            </div>
            <div class="form-group">
                <label for="sistema_calefaccion">Sistema de calefacción:</label>
                <select class="form-control" id="sistema_calefaccion" name="sistema_calefaccion">
                    <option value="1">Eléctrico</option>
                    <option value="2">Gas</option>
                    <option value="3">Leña</option>
                    <option value="4">Otros</option>
                </select>
            </div>
            <div class="form-group">
                <label for="km_anuales">Kilómetros recorridos anualmente:</label>
                <input type="number" class="form-control" id="km_anuales" name="km_anuales">
            </div>
            <div class="form-group">
                <label for="consumo_combustible">Consumo de combustible por cada 100 km (litros):</label>
                <input type="number" class="form-control" id="consumo_combustible" name="consumo_combustible">
            </div>
            <div class="form-group">
                <label for="frecuencia_transporte_publico">Frecuencia de uso del transporte público:</label>
                <select class="form-control" id="frecuencia_transporte_publico" name="frecuencia_transporte_publico">
                    <option value="1">Nunca</option>
                    <option value="2">Ocasionalmente</option>
                    <option value="3">Frecuentemente</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tipo_dieta">Tipo de dieta:</label>
                <select class="form-control" id="tipo_dieta" name="tipo_dieta">
                    <option value="1">Vegetariana</option>
                    <option value="2">Omnívora</option>
                    <option value="3">Vegana</option>
                </select>
            </div>
            <div class="form-group">
                <label for="frecuencia_carne_lacteos">Frecuencia de consumo de carne y lácteos:</label>
                <select class="form-control" id="frecuencia_carne_lacteos" name="frecuencia_carne_lacteos">
                    <option value="1">Rara vez</option>
                    <option value="2">Ocasionalmente</option>
                    <option value="3">Frecuentemente</option>
                </select>
            </div>
            <div class="form-group">
                <label for="origen_alimentos">Origen de los alimentos:</label>
                <select class="form-control" id="origen_alimentos" name="origen_alimentos">
                    <option value="1">Local</option>
                    <option value="2">Importado</option>
                </select>
            </div>
            <div class="form-group">
                <label for="basura_diaria">Basura producida diariamente (kg):</label>
                <input type="number" class="form-control" id="basura_diaria" name="basura_diaria">
            </div>
            <div class="form-group">
                <label for="reciclaje_compostaje">¿Reciclas o compostas tus residuos?</label>
                <select class="form-control" id="reciclaje_compostaje" name="reciclaje_compostaje">
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="consumo_agua">Consumo de agua diario (litros):</label>
                <input type="number" class="form-control" id="consumo_agua" name="consumo_agua">
            </div>
            <div class="form-group">
                <label for="origen_agua">Origen del suministro de agua:</label>
                <select class="form-control" id="origen_agua" name="origen_agua">
                    <option value="1">Grifo</option>
                    <option value="2">Pozo</option>
                </select>
            </div>
            <div class="form-group">
                <label for="frecuencia_viajes_avion">Frecuencia de viajes en avión:</label>
                <select class="form-control" id="frecuencia_viajes_avion" name="frecuencia_viajes_avion">
                    <option value="1">Nunca</option>
                    <option value="2">Ocasionalmente</option>
                    <option value="3">Frecuentemente</option>
                </select>
            </div>
            <div class="form-group">
                <label for="consumo_bienes_consumo">Gasto anual en bienes de consumo:</label>
                <input type="number" class="form-control" id="consumo_bienes_consumo" name="consumo_bienes_consumo">
            </div>
            <div class="form-group">
                <label for="transporte_trabajo_estudios">Transporte al trabajo o estudios:</label>
                <select class="form-control" id="transporte_trabajo_estudios" name="transporte_trabajo_estudios">
                    <option value="1">Automóvil</option>
                    <option value="2">Transporte público</option>
                    <option value="3">Bicicleta</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tipo_energia_trabajo_estudios">Tipo de energía en el trabajo o estudios:</label>
                <select class="form-control" id="tipo_energia_trabajo_estudios" name="tipo_energia_trabajo_estudios">
                    <option value="1">Electricidad</option>
                    <option value="2">Gas natural</option>
                    <option value="3">Otros</option>
                </select>
            </div>
            <div class="form-group">
                <label for="otras_actividades_impacto">¿Realizas otras actividades con impacto significativo?</label>
                <select class="form-control" id="otras_actividades_impacto" name="otras_actividades_impacto">
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Calcular Huella de Carbono</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
