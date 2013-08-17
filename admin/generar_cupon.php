<?php  
session_start();
error_reporting(E_ALL ^ E_NOTICE);


if(isset($_POST['nombre_cupon'])){
	$_SESSION['nombre_cupon'] = $_POST['nombre_cupon'];
}
if(isset($_POST['codigo'])){
	$_SESSION['codigo'] = $_POST['codigo'];
}
else
{
$_SESSION['codigo'] = " ";	
}
if(isset($_POST['estado'])){
	$_SESSION['estado'] = $_POST['estado'];
}
if(isset($_POST['tipo_cupon'])){
	$_SESSION['tipo_cupon'] = $_POST['tipo_cupon'];
}

if(isset($_POST['dia1'])){
	$_SESSION['dia1'] = $_POST['dia1'];
}
if(isset($_POST['mes1'])){
	$_SESSION['mes1'] = $_POST['mes1'];
}

if(isset($_POST['anio1'])){
	$_SESSION['anio1'] = $_POST['anio1'];
}
if(isset($_POST['dia2'])){
	$_SESSION['dia2'] = $_POST['dia2'];
}
if(isset($_POST['mes2'])){
	$_SESSION['mes2'] = $_POST['mes2'];
}

if(isset($_POST['anio2'])){
	$_SESSION['anio2'] = $_POST['anio2'];
}

	$_SESSION['total_disponibles'] = $_POST['total_disponibles'];

if(isset($_POST['valor'])){
	$_SESSION['valor'] = $_POST['valor'];
}
if($_POST['cliente']==0){

	$_SESSION['id']=0;
}else{
	$_SESSION['id']=$_POST['cliente'];
}

//echo $_SESSION['total_disponibles'];
//echo $_SESSION['valor'];

$ini_cupon=mt_rand(100000,999999);
	 $_SESSION["codigo"]=$ini_cupon;
	 
header("location:cupones.php");	

?>