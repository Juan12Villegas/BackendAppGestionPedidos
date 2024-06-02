<?php
// Incluye el archivo de conexión a la base de datos
require_once 'Conexion.php';

// Establecer la cabecera para la respuesta en formato JSON
header('Content-Type: application/json');

// Inicializar la respuesta como un array
$response = array();

// Verifica si se han enviado datos desde la aplicación Android
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtiene los datos enviados desde la aplicación Android
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $numero = $_POST['numero'];
    $direccion = $_POST['direccion'];
    $cargo = $_POST['cargo'];

    // Inserta los datos en la tabla de colaboradores
    $sql = "INSERT INTO colaborador (idCargo, dni, nombre, apellidos, numero, direccion) VALUES ('$cargo', '$dni', '$nombre', '$apellidos', '$numero', '$direccion')";

    if ($conexion->query($sql) === TRUE) {
        $response['message'] = "Registro exitoso";
    } else {
        $response['error'] = "Error: " . $conexion->error;
    }
} else {
    $response['error'] = "No se han recibido datos";
}

// Devolver la respuesta en formato JSON
echo json_encode($response);
?>
