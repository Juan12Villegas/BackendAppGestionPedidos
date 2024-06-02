<?php
include 'conexion.php';

$query = "SELECT * FROM Medida";
$result = $conexion->query($query);

$medidas = array();

while($row = $result->fetch_assoc()) {
    $medidas[] = $row;
}

echo json_encode($medidas);
?>