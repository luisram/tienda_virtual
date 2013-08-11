<?php require_once('Connections/tienda.php'); ?>
<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
if(!isset($_SESSION["usuario"])){
     //mysql_select_db($database_tienda) or die ("No se encuentra la base de datos especificada");
if (isset($_POST['log'])){
$nickname=$_POST['log'];
$contrasena=$_POST['pwd'];
$valido=true;
 $consulta2="SELECT * FROM cliente where usuario='$nickname' AND contrasena='$contrasena'";
         $result=sqlsrv_query($conn,$consulta2) or die (sqlsrv_error());
         $filasn= sqlsrv_num_rows($result);
         if ($filasn<=0 || isset($_GET['nologin']) ){
             
             $valido=false;
         }else{
        $rowsresult=sqlsrv_fetch_array($result);          
        $_SESSION['idusuario']= $rowsresult['id_cliente'];
             $valido=true;
             //guardamos en sesion el carnet del usuario ya que ese es el identificados en la base de datos
             $_SESSION["usuario"]=$nickname;
             header("location:detalles.php?login=true");
				echo '<script type=\"text/javascript\">alert(\"Gracias Por Registrarse\");</script>';

         }
}

	}else{
		$_SESSION["usuario"];
		
		}
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

 // $theValue = function_exists("mysql_real_escape_string") ? sqlsrv_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_detalle_proce = "-1";
if (isset($_GET['id_producto'])) {
  $colname_detalle_proce = $_GET['id_producto'];
}
//mysql_select_db($database_tienda, $tienda);
$query_detalle_proce = sprintf("SELECT prod.descripsion,prod.id_producto,prod.nombre, prod.precio,improd.main_image FROM producto as prod join imagen_producto as improd on improd.id_imagen_producto = prod.id_imagen_producto and prod.id_producto='$colname_detalle_proce'");
$detalle_proce = sqlsrv_query($conn, $query_detalle_proce) or die(sqlsrv_error());
$row_detalle_proce = sqlsrv_fetch_array($detalle_proce);
//$totalRows_detalle_proce = sqlsrv_num_rows($detalle_proce);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>INTERCONNECT</title>
<link href="css/estilo.css" type="text/css" rel="stylesheet" media="all" />
<link rel="stylesheet" href="css/slide.css" type="text/css" media="screen" />
<script src="jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>  
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
	<!-- Sliding effect -->
	<script src="js/slide.js" type="text/javascript"></script>

</head>
<body>
<div id="toppanel">
	<div id="panel">
		<div class="content clearfix">
			<div class="left">
				<h1>Bienvendo a Interconnect</h1>
				<h2>Tienda especializada en articulos informaticos</h2>		
				<p class="grey">Gracias por visitarnos, si aun no es miembro puede registrarse en este panel.Y si ya es miembro puede entrar con sus datos correspondientes!</p>
				
			</div>
			<div class="left">
				<!-- Login Form -->
				<form class="clearfix" action="detalles.php" method="post">
					<h1>Miembros</h1>
					<label class="grey" for="log">Usuario:</label>
					<input class="field" type="text" name="log" id="log" value="" size="23" />
					<label class="grey" for="pwd">Contraeña:</label>
					<input class="field" type="password" name="pwd" id="pwd" size="23" />
	            	<label><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> &nbsp;Recordarme</label>
        			<div class="clear"></div><?php
                    if (!isset($_SESSION["usuario"])) {
          echo "<input type='submit' name='submit' value='Entrar' class='bt_login' />";
           echo "<a href='nuevo_usuario.php'>Registrate ahora!</a>";
                    }
                    else{
                        echo "<a href='logout.php'> Cerrar Sesion</a>";
                    }?>
			</div>
			
		</div>
</div> <!-- /login -->	

	<!-- The tab on top -->	
	<div class="tab">
		<ul class="login">
			<li class="left">&nbsp;</li>
			<li>Hola <?php if (!isset($_SESSION["usuario"])) {
			echo "Invitado";}else {echo $_SESSION["usuario"];} ?></li>
			<li class="sep">|</li>
			<li id="toggle">
				<a id="open" class="open" href="#">Entrar</a>
				<a id="close" style="display: none;" class="close" href="#">Cerrar Panel</a>			
			</li>
			<li class="right">&nbsp;</li>
		</ul> 
	</div> <!-- / top -->
	
</div>
<div id="total">


   	<div id="contenido">
	    	<div id="cabecera">
            <div id="nav">
    	<ul>
        <li><a href="index.php" class="main">Inicio</a></li>
        <li><img src="img/naviseparator.gif" alt="" width="40" height="13" /></li>
         <li><a href="nosotros.php" class="main">Nosotros</a></li>
         <li><img src="img/naviseparator.gif" alt="" width="40" height="13" /></li>
          <li><a href="categorias.php" class="main">Productos</a></li>
         
          <li><img src="img/naviseparator.gif" alt="" width="40" height="13" /></li>
           <li><a href="contacto.php" class="main">Contacto</a></li>
           <li><img src="img/naviseparator.gif" alt="" width="40" height="13" /></li>
           <li><a href="carrito.php" class="main">Carrito</a></li>
        </ul>
	</div>
            	<div class="FL"></div>
                <div class="FR"></div>
        </div>
        <div class="categorias">
<br>
	<table width="100%" height="100%" border="1" align="center">
    <tr align="center">
    	<td><form name="form1" method="post" action="carrito.php">
              <input type="image" name="imageField" id="imageField" src="imagenes/comprar.gif">
              <input name="id_producto" type="hidden" id="id_producto" value="<?php echo $row_detalle_proce['id_producto']; ?>">
              <input name="nombre" type="hidden" id="nombre" value="<?php echo $row_detalle_proce['nombre']; ?>">
              <input name="precio" type="hidden" id="precio" value="<?php echo $row_detalle_proce['precio']; ?>">
              <input name="cantidad" type="hidden" id="cantidad" value="1">
            </form></td>
    </tr>
	  <tr>
	    <td align="center" class="producto_titulo"><p><?php echo $row_detalle_proce['nombre']; ?></p>
	      <p>&nbsp;</p></td>
	    </tr>
	  <tr>
	    <td align="center"><p><?php echo nl2br($row_detalle_proce['descripsion']); ?></p>
	      <p>&nbsp;</p></td>
	    </tr>
	  <tr>
	    <td align="center"><img src="<?php echo $row_detalle_proce['main_image']; ?>" width="200" height="200"></td>
	    </tr>
	  </table>
	<p> 
    </p>
    </div>
        </div>
 
    <div id="pie">
    <p>Copyright 2013 - INTERCONNECT </p>
    </div>
    </div>
</body>
</html>
