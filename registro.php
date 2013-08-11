<?php 
session_start();
require_once('Connections/tienda.php'); 
$usuario=$_POST['nickname'];
$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$email=$_POST['e-mail'];
$birthdate=$_POST['dia']."-".$_POST['mes']."-".$_POST['anio'];
$contrasena=$_POST['contrasena'];
$contrasena_vali=$_POST['contrasena_vali'];
$pais=$_POST['pais'];
$ciudad=$_POST['ciudad'];
$telefono=$_POST['telefono'];

if($contrasena==$contrasena_vali)
{
$consulta="INSERT INTO cliente (nombre,apellido,email,telefono,birthdate,usuario,contrasena) 
 VALUES ('$nombre','$apellido','$email','$telefono','$birthdate','$usuario','$contrasena')";
         sqlsrv_query($conn, $consulta) or die (sqlsrv_errors());
}else
{

}
header("location:index.php");
?>