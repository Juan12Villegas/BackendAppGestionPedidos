<?php
include 'conexion.php';

$query = "SELECT * FROM Salon";
$result = $conexion->query($query);

$salons = array();

while($row = $result->fetch_assoc()) {
    $salons[] = $row;
}

echo json_encode($salons);
?>