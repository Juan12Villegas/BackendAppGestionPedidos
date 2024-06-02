<?php
// Incluir el archivo de conexión
include 'Conexion.php';

// Consulta SQL para obtener los cargos
$sql = "SELECT idCargo, nombreCargo FROM cargo";
$result = $conexion->query($sql);

$cargos = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $cargos[] = $row;
    }
}

// Devolver los datos en formato JSON
echo json_encode($cargos);

$conexion->close();
?>
