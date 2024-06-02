<?php
include 'Conexion.php';

if (isset($_POST['dni'])) {
    $dni = $_POST['dni'];

    $query = "SELECT COUNT(*) as count FROM colaborador WHERE dni = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('s', $dni);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();

    if ($count > 0) {
        echo json_encode(array("exists" => true));
    } else {
        echo json_encode(array("exists" => false));
    }

    $stmt->close();
    $conexion->close();
} else {
    echo json_encode(array("error" => "No DNI provided"));
}
?>
