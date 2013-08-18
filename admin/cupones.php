<?php
session_start(); 
error_reporting(E_ALL ^ E_NOTICE);
require_once('../Connections/tienda.php'); 

$nombre_cupon= $_SESSION['nombre_cupon'];       
$codigo = $_SESSION['codigo'];
$estado = $_SESSION['estado'];
$tipo_cupon = $_SESSION['tipo_cupon'];
$total_disponibles = $_SESSION['total_disponibles'];
$valor = $_SESSION['valor'];
$ectado_radio1="checked";

if($estado=="activo")
{
  $ectado_radio1="checked";
}
if($estado=="inactivo")
{
  $ectado_radio2="checked";
}
/////
$tipo_cupon1="checked";
if($tipo_cupon=="all")
{
  $tipo_cupon1="checked";
}
if($tipo_cupon=="only")
{
  $tipo_cupon2="checked";
}

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
      
  </li>

</ul>
</div>
</div>
</form>
<!--CONTENIDO AQUI-->
 <form name="form1" method="POST" action="generar_cupon.php">
<div class="FL"><!--<img src="../img/carrito.jpg"/>--></div>
   <table width="90%"  height="90%"  align="center">
   <tr align="center" style="background-color:#008fbe; color:#fff">
    <td align="right">Nombre:</td>
    <td align="left"><input type="text" name="nombre_cupon" value="<?php echo $nombre_cupon; ?>"/></td>
    
  </tr>

<tr  style="background-color:#008fbe; color:#fff">
    <td align="right">Para un solo cliente:</td>
    <td align="left"><select name="cliente"> <?php
    $consulta_productos="SELECT * FROM cliente";
         $result=sqlsrv_query($conn, $consulta_productos) or die (sqlsrv_errors());
         $nm=$_SESSION['nombre'];
         //$_SESSION['id'] =0;
         $id= $_SESSION['id'];
         if ($id==0) {
           # code...
          echo "<option value='0'> Seleccione un nombre </option>";
        }else
        {
         echo "<option value='$id' selected>  $nm </option>";
         }
                  while( $row = sqlsrv_fetch_array($result)) {
                 $id_clint=$row['id_cliente'];
                 $nombre=$row['apellido'].", ".$row['nombre'];
                 $_SESSION['nombre']=$nombre;
                 
         
                 echo "<option value='$id_clint'> $nombre </option>";

                 } 
          
         
     ?>"></select></td>
      
    
  </tr>
  
  <tr align="center" style="background-color:#008fbe; color:#fff">
    <td align="right">Estado:</td>
    <td align="left"><input type="radio" name="estado" value="activo" <?php echo $ectado_radio1; ?> />activo

<input type="radio" name="estado" value="inactivo"  <?php echo $ectado_radio2; ?>/>inactivo</td>
    
  </tr> 
  <tr align="center" style="background-color:#008fbe; color:#fff">
    <td align="right">Tipo de cupon:</td>
    <td align="left"><input type="radio" name="tipo_cupon" value="all" <?php echo $tipo_cupon1; ?> />Todo publico

<input type="radio" name="tipo_cupon" value="only"  <?php echo $tipo_cupon2; ?>/>Un solo cliente</td>
    
  </tr> 
<tr  style="background-color:#008fbe; color:#fff">
    <td align="right">Total Disponibles:</td>
    <td align="left"><input type="text" name="total_disponibles" value="<?php echo $total_disponibles;?>"/></td>
    
  </tr>
  <tr  style="background-color:#008fbe; color:#fff">
    <td align="right">Valor %:</td>
    <td align="left"><input type="text" name="valor" value="<?php echo $valor;?>"/></td>
    
  </tr>
  <tr  style="background-color:#008fbe; color:#fff">
    <td></td>
    
    
  </tr>
  
  <tr align="center" style="background-color:#008fbe; color:#fff">
    <td align="right">Valido desde:</td>
    <td align="left"><select name="dia1">
  <?php
    for($d=1;$d<=31;$d++)
    {
      if($d<10)
        $dd = "0" . $d;
      else
        $dd = $d;
      echo "<option value='$dd'>$dd</option>";
    }
  ?>
</select>
<select name="mes1">
<?php
  for($m = 1; $m<=12; $m++)
  {
    if($m<10)
      $me = "0" . $m;
    else
      $me = $m;
    switch($me)
    {
      case "01": $mes = "Enero"; break;
      case "02": $mes = "Febrero"; break;
      case "03": $mes = "Marzo"; break;
      case "04": $mes = "Abril"; break;
      case "05": $mes = "Mayo"; break;
      case "06": $mes = "Junio"; break;
      case "07": $mes = "Julio"; break;
      case "08": $mes = "Agosto"; break;
      case "09": $mes = "Septiembre"; break;
      case "10": $mes = "Octubre"; break;
      case "11": $mes = "Noviembre"; break;
      case "12": $mes = "Diciembre"; break;     
    }
    echo "<option value='$me'>$mes</option>";
  }
?>
</select> <select name="anio1">
  <?php
   $anio = date("Y");
    $anio_ultimo = $anio + 2;
    $edad_min = 13;
    for($a= $anio; $a<=$anio_ultimo; $a++)
      echo "<option value='$a'>$a</option>";  
      
  ?>
</select>
Hasta:<select name="dia2">
  <?php
    for($d=1;$d<=31;$d++)
    {
      if($d<10)
        $dd = "0" . $d;
      else
        $dd = $d;
      echo "<option value='$dd'>$dd</option>";
    }
  ?>
</select>
<select name="mes2">
<?php
  for($m = 1; $m<=12; $m++)
  {
    if($m<10)
      $me = "0" . $m;
    else
      $me = $m;
    switch($me)
    {
      case "01": $mes = "Enero"; break;
      case "02": $mes = "Febrero"; break;
      case "03": $mes = "Marzo"; break;
      case "04": $mes = "Abril"; break;
      case "05": $mes = "Mayo"; break;
      case "06": $mes = "Junio"; break;
      case "07": $mes = "Julio"; break;
      case "08": $mes = "Agosto"; break;
      case "09": $mes = "Septiembre"; break;
      case "10": $mes = "Octubre"; break;
      case "11": $mes = "Noviembre"; break;
      case "12": $mes = "Diciembre"; break;     
    }
    echo "<option value='$me'>$mes</option>";
  }
?>
</select> <select name="anio2">
  <?php
   $anio = date("Y");
    $anio_ultimo = $anio + 2;
    $edad_min = 13;
    for($a= $anio; $a<=$anio_ultimo; $a++)
      echo "<option value='$a'>$a</option>";  
      
  ?>
</select></td>
    
  </tr>
  <tr  style="background-color:#008fbe; color:#fff">
    <td align="right">Codigo:</td>
    <td align="left"><input type="text" name="codigo" value="<?php echo $codigo;?>" disabled />
      <input type="submit" value="Generar"></td>
      
    
  </tr>
   </table>
  </form>
  <form action="guardar_cupon.php">
    <td align="left" height="34"><input type="submit" name="enviar" value="Crear Cupon"/></td>
    </form>
</div>
 <div id="pie">
    <p>Copyright 2013 - INTERCONNECT </p>
    </div>
</div>
</form>
</body>
</html>