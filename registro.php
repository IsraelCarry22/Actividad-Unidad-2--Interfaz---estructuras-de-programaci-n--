<?php
// Conexión a SQL Server Express
$serverName = "localhost\\SQLEXPRESS";
$connectionInfo = array("Database" => "BecasDB", "UID" => "usuario", "PWD" => "contraseña");
$conn = sqlsrv_connect($serverName, $connectionInfo);

if ($conn === false) {
    die(json_encode(["error" => sqlsrv_errors()]));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $curp = $_POST["curp"];

    $query = "INSERT INTO estudiantes (nombre, correo, curp) VALUES (?, ?, ?)";
    $params = array($nombre, $correo, $curp);
    $stmt = sqlsrv_query($conn, $query, $params);

    if ($stmt) {
        echo json_encode(["success" => "Registro exitoso"]);
    } else {
        echo json_encode(["error" => sqlsrv_errors()]);
    }
}

sqlsrv_close($conn);
?>
