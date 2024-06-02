<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idSalon = $_POST['idSalon'];
    $nombreMesa = $_POST['nombreMesa'];

    // Contar las mesas existentes para el salón y acrónimo específicos
    $stmt = $conexion->prepare("SELECT COUNT(*) AS count FROM Mesa WHERE idSalon = ?");
    $stmt->bind_param("i", $idSalon);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $count = $row['count'];

    // Generar nombre secuencial para la nueva mesa
    $nombreMesaSecuencial = $nombreMesa . '-' . ($count + 1);

    // Insertar en la base de datos
    $stmt = $conexion->prepare("INSERT INTO Mesa (idSalon, nombreMesa) VALUES (?, ?)");
    $stmt->bind_param("is", $idSalon, $nombreMesaSecuencial);

    if ($stmt->execute()) {
        echo "Mesa agregada exitosamente";
    } else {
        echo "Error al agregar mesa";
    }

    $stmt->close();
    $conexion->close();
}
?>
