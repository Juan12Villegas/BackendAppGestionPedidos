<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombreCategoriaProducto = $_POST['nombreCategoriaProducto'];

    // Verificar si el nombre de la categoría ya existe en la base de datos
    $stmt = $conexion->prepare("SELECT idCategoriaProducto FROM categoriaProducto WHERE nombreCategoriaProducto = ?");
    $stmt->bind_param("s", $nombreCategoriaProducto);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // La categoría ya existe en la base de datos
        echo "La categoría ya existe";
    } else {
        // La categoría no existe, insertarlo en la base de datos
        $stmt = $conexion->prepare("INSERT INTO categoriaProducto (nombreCategoriaProducto) VALUES (?)");
        $stmt->bind_param("s", $nombreCategoriaProducto);

        if ($stmt->execute()) {
            echo "Categoría agregada exitosamente";
        } else {
            echo "Error al agregar categoria";
        }
    }

    $stmt->close();
    $conexion->close();
}
?>
