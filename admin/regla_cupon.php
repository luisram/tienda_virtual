<?php
session_start(); 
error_reporting(E_ALL ^ E_NOTICE);
require_once('../Connections/tienda.php'); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<title>
</title>

<head>
	<title>INTERCONNECT</title>

<link href="../css/estilo-admin.css" type="text/css" rel="stylesheet" media="all" />
</head>
<body>
	<form>
    <div id="total">
  <div id="contenido">
        <div id="cabecera">
            <div id="nav">
    <ul class="mi-menu">
  <li><a href="index.php"> Inicio </a></li>
  <li>
    <a href="#"> Promociones </a>
    <ul>
      <li><a href="cupones.php"> Cupones </a></li>
      <li><a href="productos.php"> Promociones </a></li>
      
    </ul>
  </li>
   <li>
    <a href="#"> Clientes </a>
    <ul>
      <li><a href=""> Admin Clientes </a></li>
      <li><a href=""> Detalles </a></li>
      
    </ul>
  </li>
    <li>
    <a href="#"> Catalogo </a>
    <ul>
      <li><a href=""> Categorias </a></li>
      <li><a href="p"> Productos </a></li>
      
    </ul>
  </li>

</ul>
</div>
</div>
</form>
<!--CONTENIDO AQUI-->
 <form name="form1" method="POST" action="generar_cupon.php">
<div class="FL"><!--<img src="../img/carrito.jpg"/>--></div>
   <table width="90%"  height="90%"  align="center">
 
   </table>
  </form>

</div>
 <div id="pie">
    <p>Copyright 2013 - INTERCONNECT </p>
    </div>
</div>
</form>
</body>
</html>
?>