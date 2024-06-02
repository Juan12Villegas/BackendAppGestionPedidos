<?php
include 'Conexion.php';

// Verificar si se recibió el parámetro idSalon
if(isset($_GET['idCategoria'])) {
    $idCategoria = $_GET['idCategoria'];

    // Consulta SQL para obtener las mesas por ID de salón
    $sql = "SELECT * FROM producto p INNER JOIN categoriaProducto cp ON p.idCategoriaProducto = cp.idCategoriaProducto INNER JOIN medida m ON p.idMedida = m.idMedida WHERE p.idCategoriaProducto = $idCategoria";
    $result = $conexion->query($sql);

    $productos = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $productos[] = $row;
        }
    }

    // Devolver los datos en formato JSON
    echo json_encode($productos);
} else {
    // No se recibió el parámetro idSalon
    echo "ID de categoria no proporcionado";
}

$conexion->close();
?>