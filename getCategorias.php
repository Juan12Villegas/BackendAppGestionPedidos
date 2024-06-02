<?php
include 'conexion.php';

$query = "SELECT * FROM categoriaProducto";
$result = $conexion->query($query);

$categorias = array();

while($row = $result->fetch_assoc()) {
    $categorias[] = $row;
}

echo json_encode($categorias);
?>