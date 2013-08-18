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
$genero=$_POST['genero'];
$msg="                                                                                                                                                                                 
     ";
$ctrl=0;
$call_p = "{call nuevo_usuario( ?, ? ,? ,? ,? ,? ,? ,? ,?,? )}";
 
	$parametros = array( 
                 array($nombre, SQLSRV_PARAM_IN),
                 array($apellido, SQLSRV_PARAM_IN),
                 array($email, SQLSRV_PARAM_IN),
                 array($telefono, SQLSRV_PARAM_IN),
                 array($birthdate, SQLSRV_PARAM_IN),
                 array($genero, SQLSRV_PARAM_IN),
                 array($usuario, SQLSRV_PARAM_IN),
                 array($contrasena, SQLSRV_PARAM_IN),
                 array($msg, SQLSRV_PARAM_OUT),
                 array($ctrl, SQLSRV_PARAM_OUT)
               );

/* Execute the query. 
 //$ejecuta_call_p=sqlsrv_query( $conn, $call_p, $parametros);
*/

$ejecuta_call_p=sqlsrv_query( $conn, $call_p, $parametros); 
	/////////////////////////////////
           if ($ctrl==0) {
           
            $valido=true;

 $call_p = "{call login_usuario( ?, ? ,? ,?,? )}";

 
$id_cliente=0;
$user_name="              ";
$error=0;     
$parametros = array( 
                 array($usuario, SQLSRV_PARAM_IN),
                 array($contrasena, SQLSRV_PARAM_IN),
                 array($id_cliente, SQLSRV_PARAM_OUT),
                 array($user_name, SQLSRV_PARAM_OUT),
                 array($error, SQLSRV_PARAM_OUT)
               );

/* Execute the query. 
 //$ejecuta_call_p=sqlsrv_query( $conn, $call_p, $parametros);
*/

$ejecuta_call_p=sqlsrv_query( $conn, $call_p, $parametros);    
       if ($error==0) {
           $_SESSION['idusuario']= $id_cliente;
             $valido=true;
             //guardamos en sesion el carnet del usuario ya que ese es el identificados en la base de datos
             $_SESSION["usuario"]=$user_name;
             //echo $id_cliente;
            // echo $user_name;
           header("location:".$_SESSION['page_return']."");# code...
       }else
       {

       }
         //  header("location:index.php");# code...
       }else
       {
         echo $ctrl;
         echo $msg;echo "<br>";
       }
 
?>