<?php
    $Nombre = $_GET["nombre"];
    $ApellidoPaterno = $_GET["apellido_paterno"];
    $ApellidoMaterno = $_GET["apellido_materno"];
    $Correo = $_GET["correo"];
    $CURP = $_GET["curp"];
    $Telefono = $_GET["telefono"];
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Becas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center">Solicitud de Beca</h2>
        <form class="p-4 bg-white shadow rounded" action="TablaResgistros.php" method="POST">
            <div class="mb-3">
                <label for="tipoBeca" class="form-label">Tipo de Beca</label>
                <select class="form-select" id="tipoBeca" name="tipoBeca" required>
                    <option value="">Selecciona una opción</option>
                    <option value="académica">Académica</option>
                    <option value="deportiva">Deportiva</option>
                    <option value="cultural">Cultural</option>
                    <option value="gobierno">Gobierno</option>
                    <option value="trabajo">Trabajo</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="ingresos" class="form-label">Ingresos Mensuales</label>
                <input type="number" class="form-control" id="ingresos" name="ingresos" required>
            </div>
            <div class="mb-3">
                <label for="promedio" class="form-label">Promedio</label>
                <input type="number" class="form-control" id="promedio" name="promedio" step="0.1" required>
            </div>

            <input type="hidden" class="form-control" id="nombre" value="<?php echo htmlspecialchars($Nombre, ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" class="form-control" id="apellido_paterno" value="<?php echo htmlspecialchars($ApellidoPaterno, ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" class="form-control" id="apellido_materno" value="<?php echo htmlspecialchars($ApellidoMaterno, ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" class="form-control" id="correo" value="<?php echo htmlspecialchars($Correo, ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" class="form-control" id="curp" pattern="[A-Z0-9]{10,18}" value="<?php echo htmlspecialchars($CURP, ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" class="form-control" id="telefono"  value="<?php echo htmlspecialchars($Telefono, ENT_QUOTES, 'UTF-8'); ?>">
            <button type="submit" class="btn btn-success w-100">Solicitar Beca</button>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
