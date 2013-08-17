<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
require_once('Connections/tienda.php'); 




$page_return=$_SESSION['page_return'];
if (isset($_POST['log'])){
$nickname=$_POST['log'];
$contrasena=$_POST['pwd'];
$valido=true;

 $call_p = "{call login_usuario( ?, ? ,? ,?,? )}";

 
$id_cliente=0;
$user_name="              ";
$error=0;     
$parametros = array( 
                 array($nickname, SQLSRV_PARAM_IN),
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
   }       
?>