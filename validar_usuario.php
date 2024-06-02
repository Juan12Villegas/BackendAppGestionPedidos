<?php
include 'conexion.php';
$usu_usuario=$_POST['usuario'];
$usu_password=$_POST['password'];

/* $usu_usuario="admin";
$usu_password="1207"; */

//$usu_usuario="admin";
//$usu_password="1207";

$sentencia=$conexion->prepare("SELECT * FROM usuario u INNER JOIN colaborador c ON u.idColaborador = c.idColaborador WHERE usu_usuario=? AND usu_password=?");
$sentencia->bind_param('ss',$usu_usuario,$usu_password);
$sentencia->execute();

$resultado = $sentencia->get_result();
if ($fila = $resultado->fetch_assoc()) {
         echo json_encode($fila,JSON_UNESCAPED_UNICODE);     
}
$sentencia->close();
$conexion->close();
?>