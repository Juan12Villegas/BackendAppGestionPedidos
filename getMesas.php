<?php
// Incluir el archivo de conexión
include 'Conexion.php';

// Consulta SQL para obtener las mesas
$sql = "SELECT * FROM mesa";
$result = $conexion->query($sql);

$mesas = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $mesas[] = $row;
    }
}

// Devolver los datos en formato JSON
echo json_encode($mesas);

$conexion->close();
?>
