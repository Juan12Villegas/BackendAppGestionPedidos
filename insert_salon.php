<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombreSalon = $_POST['nombreSalon'];

    // Verificar si el nombre del salón ya existe en la base de datos
    $stmt = $conexion->prepare("SELECT idSalon FROM Salon WHERE nombreSalon = ?");
    $stmt->bind_param("s", $nombreSalon);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // El salón ya existe en la base de datos
        echo "El salón ya existe";
    } else {
        // El salón no existe, insertarlo en la base de datos
        $stmt = $conexion->prepare("INSERT INTO Salon (nombreSalon) VALUES (?)");
        $stmt->bind_param("s", $nombreSalon);

        if ($stmt->execute()) {
            echo "Salón agregado exitosamente";
        } else {
            echo "Error al agregar salón";
        }
    }

    $stmt->close();
    $conexion->close();
}
?>
