<?php
// Configuración de la base de datos
$serverName = "localhost\SQLEXPRESS"; // Servidor de SQL Server Express
$database = "BecasDB"; // Nombre de la base de datos
$username = "IsraelBecas"; // Usuario de SQL Server
$password = "220504"; // Contraseña del usuario

try {
    $conn = new PDO("sqlsrv:Server=$serverName;Database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

$Nombre = $_POST["nombre"];
$ApellidoPaterno = $_POST["apellido_paterno"];
$ApellidoMaterno = $_POST["apellido_materno"];
$Correo = $_POST["correo"];
$CURP = $_POST["curp"];
$Telefono = $_POST["telefono"];
$tipoBeca = $_POST["tipoBeca"];
$ingresos = $_POST["ingresos"];
$promedio = $_POST["promedio"];

if (!empty($Nombre) && !empty($ApellidoPaterno) && !empty($Correo) && !empty($tipoBeca)) {
    try {
        $sql = "INSERT INTO becas (nombre, apellido_paterno, apellido_materno, correo, curp, telefono, tipo_beca, ingresos, promedio, estado) 
                VALUES (:nombre, :apellido_paterno, :apellido_materno, :correo, :curp, :telefono, :tipo_beca, :ingresos, :promedio, 'Pendiente')";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ":nombre" => $Nombre,
            ":apellido_paterno" => $ApellidoPaterno,
            ":apellido_materno" => $ApellidoMaterno,
            ":correo" => $Correo,
            ":curp" => $CURP,
            ":telefono" => $Telefono,
            ":tipo_beca" => $tipoBeca,
            ":ingresos" => $ingresos,
            ":promedio" => $promedio
        ]);
    } catch (PDOException $e) {
        die("Error al insertar datos: " . $e->getMessage());
    }
}

$sql = "SELECT id, curp, nombre, apellido_paterno, apellido_materno, tipo_beca, estado FROM becas";
$solicitudes = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
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
        <h2 class="text-center">Solicitudes de Beca</h2>
        <table class="table table-striped bg-white shadow rounded">
            <thead>
                <tr>
                    <th>#</th>
                    <th>CURP</th>
                    <th>Nombre</th>
                    <th>Ape Paterno</th>
                    <th>Ape Materno</th>
                    <th>Tipo de Beca</th>
                    <th>Promedio</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($solicitudes) > 0): ?>
                    <?php foreach ($solicitudes as $solicitud): ?>
                        <tr>
                            <td><?= htmlspecialchars($solicitud["id"]) ?></td>
                            <td><?= htmlspecialchars($solicitud["curp"]) ?></td>
                            <td><?= htmlspecialchars($solicitud["nombre"]) ?></td>
                            <td><?= htmlspecialchars($solicitud["apellido_paterno"]) ?></td>
                            <td><?= htmlspecialchars($solicitud["apellido_materno"]) ?></td>
                            <td><?= htmlspecialchars($solicitud["promedio"]) ?></td>
                            <td><?= htmlspecialchars($solicitud["tipo_beca"]) ?></td>
                            <td class="text-warning"><?= htmlspecialchars($solicitud["estado"]) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No hay solicitudes registradas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
