<?php
include 'Conexion.php';

// Verificar si se recibió el parámetro idSalon
if(isset($_GET['idSalon'])) {
    $idSalon = $_GET['idSalon'];

    // Consulta SQL para obtener las mesas por ID de salón
    $sql = "SELECT * FROM mesa WHERE idSalon = $idSalon";
    $result = $conexion->query($sql);

    $mesas = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $mesas[] = $row;
        }
    }

    // Devolver los datos en formato JSON
    echo json_encode($mesas);
} else {
    // No se recibió el parámetro idSalon
    echo "ID de salón no proporcionado";
}

$conexion->close();
?>