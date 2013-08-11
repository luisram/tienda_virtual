<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
//manejamos en sesion el nombre del usuario que se ha logeado
require_once('Connections/tienda.php'); 

if(!isset($_SESSION["usuario"])){

    // sqlsrv_select_db($database_tienda) or die ("No se encuentra la base de datos especificada");
if (isset($_POST['log'])){
$nickname=$_POST['log'];
$contrasena=$_POST['pwd'];
$valido=true;
 $consulta2="SELECT * FROM cliente where usuario='$nickname' AND contrasena='$contrasena'";
         $result=sqlsrv_query($conn, $consulta2) or die (sqlsrv_errors());
         $filasn= sqlsrv_num_rows($result);
         //$filasn<=0 || 
         if (isset($_GET['nologin']) ){
             
             $valido=false;
         }else{
        $rowsresult=sqlsrv_fetch_array($result);          
        $_SESSION['idusuario']= $rowsresult['id_cliente'];
             $valido=true;
             //guardamos en sesion el carnet del usuario ya que ese es el identificados en la base de datos
             $_SESSION["usuario"]=$nickname;
             header("location:carrito.php?login=true");
				echo '<script type=\"text/javascript\">alert(\"Gracias Por Registrarse\");</script>';

         }
}

	}else{
		$_SESSION["usuario"];
    $_SESSION["descuento"];
		
		}


if ( isset($_SESSION['carrito']) || isset($_POST['nombre'])){
			
	if(isset ($_SESSION['carrito'])){
		$compras=$_SESSION['carrito'];
		if(isset($_POST['nombre'])){
    $id_producto=$_POST['id_producto'];
		$nombre=$_POST['nombre'];
		$precio=$_POST['precio'];
		$cantidad=$_POST['cantidad'];
		$duplicado=-1;
			for($i=0;$i<=count($compras)-1;$i++){
				if($nombre==$compras[$i]['nombre']){
					$duplicado=$i;

				}
			}

if($duplicado != -1){
	$cantidad_nueva = $compras[$duplicado]['cantidad'] + $cantidad;
		$compras[$duplicado]=array("nombre"=>$nombre,"id_producto"=>$id_producto,"precio"=>$precio,"cantidad"=>$cantidad_nueva);
}else {
		$compras[]=array("nombre"=>$nombre,"id_producto"=>$id_producto,"precio"=>$precio,"cantidad"=>$cantidad);
}
				}
}else {
	$id_producto=$_POST['id_producto'];
  $nombre=$_POST['nombre'];
	$precio=$_POST['precio'];
	$cantidad=$_POST['cantidad'];
	$compras[]=array("nombre"=>$nombre,"id_producto"=>$id_producto,"precio"=>$precio,"cantidad"=>$cantidad);
}
if(isset($_POST['cantidadactualizada'])){
	$id=$_POST['id'];
	$contador_cant=$_POST['cantidadactualizada'];
	if($contador_cant<1){
		$compras[$id]=NULL;
	}else{
		$compras[$id]['cantidad']=$contador_cant;
		}
}
if(isset($_POST['id2'])){
	$id=$_POST['id2'];
	$compras[$id]=NULL;

}
$_SESSION['carrito']=$compras;

}
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
				<form class="clearfix" action="carrito.php" method="post">
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
				</form>
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
            	<div class="FL"><img src="img/carrito.jpg"/></div>
                <div class="FR"></div>
                <div class="categorias">
 <br>
    <p style=" text-align:center; margin-bottom:10px; clear:both;"><br /><a href="javascript:history.back(1)">ATRAS</a>   
      <br>
    <table width="90%"  height="90%"border="1" align="center" id="tablacarrito">
<tr align="center" style="background-color:#008fbe; color:#fff">
    <td width="27%">PRODUCTO</td>
    <td width="18%">PRECIO</td>
    <td width="37%">CANTIDAD</td>
    <td width="18%">TOTAL</td>
  </tr>
  <?php
  if(isset($_SESSION['carrito'])){
	  $total=0;

for($i=0;$i<=count($compras)-1;$i++){
	
	if($compras[$i]!=NULL){
	
  ?>
  <tr align="center">
    <td><?php echo $compras[$i]['nombre']; echo $compras[$i]['id_producto']; ?></td>
    <td><?php echo $compras[$i]['precio']; ?></td>
    <td>
      <form name="form1" method="post" action="">
      <input type="hidden" name="id" id="id" value="<?php echo $i;?>">
      <input type="text" name="cantidadactualizada" value="<?php echo $compras[$i]['cantidad'];?>"  size="2">
      <span id="toolTipBox" width="200"></span>
        <input type="image" name="actualizar" id="actualizar" src="imagenes/actualizar.gif" onmouseover="toolTip('Presione para actualizar su pedido',this)">
      </form></td>
    <td>
	<form method="post" action=""><?php echo $compras[$i]['cantidad'] * $compras[$i]['precio'];?>
    <span id="toolTipBox" width="200"></span>
       <input name="id2" type="hidden" id="id2" value="<?php echo $i;?>"> 
               <input type="image" name="imageField" id="imageField" src="imagenes/eliminar.gif" onmouseover="toolTip('Presione para eliminar su pedido',this)"></form></td>
  </tr>
  <?php
  $total= $total+($compras[$i]['cantidad'] * $compras[$i]['precio']);
}
  }
  }
  
  ?>
  <tr align="center">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><p>TOTAL A PAGAR:</p><p>&nbsp;</p>
      </td>
    <td><p> </p>
    <p><?php 
    if(isset($_SESSION['carrito'])){ 
      echo "$ ".$total." Dolares <br>";
    }
    
      
    ?></p>
    </td>


  </tr>
  <tr align="center">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="left">
      </td>
    <td><form name="form2" method="post" action="resumenc_compra.php">
      
      <input type="submit" name="button" id="button" value="Enviar Pedido">
    </form></td>
  </tr>
    </table>
</div>
        </div>
   	</div>

    <div id="pie">
    <p>Copyright 2013 - INTERCONNECT /p>
    </div>
    </div>
</body>
</html>
