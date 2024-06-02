<?php
// Incluir el archivo de conexión a la base de datos
require_once 'conexion.php';

// Establecer la cabecera para la respuesta en formato JSON
header('Content-Type: application/json');

// Consulta SQL para seleccionar todos los registros de la tabla "Colaborador"
$sql = "SELECT * FROM colaborador co INNER JOIN cargo ca ON co.idCargo = ca.idCargo";

// Ejecutar la consulta
$resultado = $conexion->query($sql);

// Verificar si la consulta fue exitosa
if ($resultado) {
    // Inicializar un array para almacenar los registros de los colaboradores
    $colaboradores = array();

    // Recorrer el resultado de la consulta y almacenar cada fila en el array
    while ($fila = $resultado->fetch_assoc()) {
        $colaboradores[] = $fila;
    }

    // Devolver los datos de los colaboradores en formato JSON
    echo json_encode($colaboradores);
} else {
    // Si hay un error en la consulta, devolver un mensaje de error en JSON
    echo json_encode(array('error' => 'Error al obtener los colaboradores'));
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>