<?php
session_start();
if(!isset($_SESSION["usuario"])){
	 $_SESSION['page_return']="index.php";
	}else{
		$_SESSION["usuario"];
		
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
<script type="text/javascript">
function comparar_contra() {
	var contra1 = document.getElementById('contra1').value;
	var contra2 = document.getElementById('contra2').value;

	if (contra1 != contra2) {
		alert('Las contraseñas no coinciden');
	} 
}
</script>
</head>
<body>
<div id="toppanel">
	<div id="panel">
		<div class="content clearfix">
			<div class="left">
				<h1>Bienvendio a Interconnect</h1>
				<h2>Tienda especializada en articulos informaticos</h2>		
				<p class="grey">Gracias por visitarnos, si aun no es miembro puede registrarse en este panel.Y si ya es miembro puede entrar con sus datos correspondientes!</p>
				
			</div>
			<div class="left">
				<!-- Login Form -->
				<form class="clearfix" action="login.php" method="post">
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
            	<div class="FL"></div>
                <div class="FR"></div>
        </div>
        <div id="registro" style="clear:both;">
 <p><img src="imagenes/miembro.gif" style="float:left;"/></p>
<div class="registro_caja"align="center">
<br>
<p align="center">Llene el siguiente formulario para poder ser miembro en INTERCONNECT</p>
<br>
<form action="registro.php" method="post">
<table width="100%" border="2">
  <tr>
    <td height="30" align="right">Usuario:</td>
    <td align="left"><input type="text" name="nickname" required /></td>
  </tr>
  <tr>
    <td height="30" align="right">Nombre:</td>
    <td align="left"><input type="text" name="nombre" required /></td>
  </tr>
  <tr>
    <td height="30"  align="right">Apellido:</td>
    <td align="left"><input type="text" name="apellido"  required/></td>
  </tr>
  <tr>
    <td height="30" align="right">E-Mail:</td>
    <td align="left"><input type="text" name="e-mail" required /></td>
  </tr>
  <tr>
    <td height="30" align="right">Tel&eacute;fono:</td>
    <td align="left"><input type="text" name="telefono" required /></td>
  </tr>
  <tr>
    <td height="30" align="right">G&eacute;nero:</td>
    <td align="left"> <select name="genero">
 
      <option value='M'>Masculino</option>
     <option value='F'>Femenino</option>
</select></td>
  </tr>
  <tr>
    <td height="30"  align="right">Cumplea&ntilde;os:</td>
    <!--/////////////////////////////dia//////////////////////////////////-->
    <td align="left">
  <select name="dia">
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
<select name="mes">
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
</select> <select name="anio">
  <?php
   $tope = date("Y");
    $edad_max = 75;
    $edad_min = 13;
    for($a= $tope - $edad_max; $a<=$tope - $edad_min; $a++)
      echo "<option value='$a'>$a</option>";  
      
  ?>
</select>

</td>
    
  </tr>
  <tr>
    <td height="30" align="right">Contraseña:</td> 
    <td align="left"><input type="password" name="contrasena" id="contra1" required  /></td>
  </tr>
  <tr>
    <td height="30"  align="right">Repetir Contraseña:</td>
    <td align="left"><input type="password" name="contrasena_vali"  id="contra2" onChange="javascript:comparar_contra(this.form)"/></td>
  </tr>
  <tr>
    <td height="30" align="right">Pais:</td>
    <td align="left">
    <select name="pais">
    <option name="pais" value="El Salvador">El Salvador</option>
    <option name="pais" value="Guatemala">Guatemala</option>
    <option name="pais" value="Honduras">Honduras</option>
    <option name="pais" value="Costa Rica">Costa Rica</option>
    <option name="pais" value="Nicaragua">Nicaragua</option>
    </select></td>
  </tr>
  <tr>
    <td height="30" align="right">Ciudad:</td>
    <td align="left"><input type="text" name="ciudad"  required/></td>
  </tr>
  
</table> 
<p align="center"><input type="submit" name="registrar" value="REGISTRARSE"   />
</form>
</div>
<!--<p><img src="imagenes/miembro_registrado.gif" style="float:left;"/></p>-->
<!--<div class="registro_caja">
<br>
<p align="center">Ingrese usando el siguiente formulario</p>
<br>
<form action="ingreso.php" method="post">
<table width="100%" border="1">
<tr>
<td height="30"  align="right">Usuario:</td>
<td align="left"><input type="text" name="nickname" required /></td>
</tr>
<tr>
<td height="30"  align="right">Contraseña:</td>
<td align="left"><input type="password" name="contrasena" required  /></td>
</tr>
</table>
<p align="center"><input type="submit" name="entrar" value="ENTRAR"   />
</form>
</div>-->
</div>
        </div>

    <div id="pie">
    <p>Copyright 2013 - INTERCONNECT</p>
    </div>
    </div>
</body>
</html>
