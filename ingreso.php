<?php 
session_start();
require_once('Connections/tienda.php'); 
     //sqlsrv_select_db($database_tienda) or die ("No se encuentra la base de datos especificada");

$nickname=$_POST['nickname'];
$contrasena=$_POST['contrasena'];
$valido=true;
 $consulta2="SELECT * FROM cliente where usuario='$nickname' AND contrasena='$contrasena'";
         $result=sqlsrv_query($conn, $consulta2) or die ("sqlsrv_error()");
         $filasn= sqlsrv_num_rows($result);
         if ($filasn<=0 || isset($_GET['nologin']) ){
              
             $valido=false;
         }else{
        $rowsresult=sqlsrv_fetch_array($result);          
        $_SESSION['idusuario']= $rowsresult['id_cliente'];
             $valido=true;
             //guardamos en sesion el carnet del usuario ya que ese es el identificados en la base de datos
             $_SESSION["usuario"]=$nickname;
             header("location:resumenc_compra.php?login=true");
				echo '<script type=\"text/javascript\">alert(\"Gracias Por Registrarse\");</script>';
                echo "ya?";

         }  


 
 header("location:carrito.php");

?>