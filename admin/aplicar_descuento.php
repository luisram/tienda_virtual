<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
require_once('../Connections/tienda.php'); 
$n_cupon= $_POST['cupon'];
 $total=$_POST['total'];
 $_SESSION['error']=NULL;
 $_SESSION['error2']=NULL;
 

 $call_p = "{call descuento_cupon( ? ,? ,? ,? ,? ,? )}";
 $fecha_final="           ";

 $id_cupon=0;

 $monto_cupon="    ";
 $ctrl=0;
$cantidad_canje=0;

   $parametros = array( 
                 array($id_cupon, SQLSRV_PARAM_OUT),
                 array($monto_cupon, SQLSRV_PARAM_OUT),
                 array($fecha_final, SQLSRV_PARAM_OUT),
                 array($ctrl, SQLSRV_PARAM_OUT),
                 array($cantidad_canje, SQLSRV_PARAM_OUT),
                 array($n_cupon, SQLSRV_PARAM_IN)
               );
   $ejecuta_call_p=sqlsrv_query( $conn, $call_p, $parametros);    

$fecha_actual=date('d').date('m').date('Y');

$fecha_operar = explode('-',$fecha_final);
//echo $cantidad_canje;
/*echo $fecha_operar;
echo $fecha_final;
echo $fecha_actual;*/
if ($fecha_actual > $fecha_operar){
  $_SESSION['error2']="LO SENTIMOS, EL PERIODO VALIDES DEL CUPON NUMERO:".$n_cupon." A CADUCADO O SE ENCUENTRA AGOTADO";
  	
}else if( $cantidad_canje <=0){
                        $_SESSION['error2']="LO SENTIMOS, EL CUPON NUMERO:".$n_cupon."SE ENCUENTRA AGOTADO";

}else if ($ctrl==1) {
           $_SESSION['error']="LO SENTIMOS ESTE CUPON NO EXISTE";
         }else {
 // $monto_cupon=$rowsresult['monto_cupon'];
   $_SESSION['id_cupon']=$id_cupon;
  $operacion1=($total * $monto_cupon)/100;
  $_SESSION['descuento']=$operacion1;
  $_SESSION['error']=NULL;

}
header("location:../resumenc_compra.php");	

?>