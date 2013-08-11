<?php
session_start();
header("location:cat_rams.php");
if(!isset($_SESSION["usuario"])){
require_once('Connections/tienda.php'); 

     //sqlsrv_select_db($database_tienda) or die ("No se encuentra la base de datos especificada");
if (isset($_POST['log'])){
$nickname=$_POST['log'];
$contrasena=$_POST['pwd'];
$valido=true;
 $consulta2="SELECT * FROM cliente where usuario='$nickname' AND contrasena='$contrasena'";
         $result=sqlsrv_query($conn, $consulta2) or die (sqlsrv_error());
        // $filasn= sqlsrv_num_rows($result);
         //if ($filasn<=0 || isset($_GET['nologin']) ){
             
         //    $valido=false;
         //}else{
        $rowsresult=sqlsrv_fetch_array($result);          
        $_SESSION['idusuario']= $rowsresult['id_cliente'];
             $valido=true;
             //guardamos en sesion el carnet del usuario ya que ese es el identificados en la base de datos
             $_SESSION["usuario"]=$nickname;
             header("location:categorias.php?login=true");
				echo '<script type=\"text/javascript\">alert(\"Gracias Por Registrarse\");</script>';

         //}
}

	}else{
		$_SESSION["usuario"];
		
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Interconnect</title>
<link href="css/estilo.css" type="text/css" rel="stylesheet" media="all" />
<link rel="stylesheet" href="css/slide.css" type="text/css" media="screen" />
<script src="jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>  
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
	<!-- Sliding effect -->
	<script src="js/slide.js" type="text/javascript"></script>

</head>
<body>

</body>
</html>
