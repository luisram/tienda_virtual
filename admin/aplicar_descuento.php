<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
require_once('../Connections/tienda.php'); 
$n_cupon= $_POST['cupon'];
 $total=$_POST['total'];
 $_SESSION['error']=NULL;
 $_SESSION['error2']=NULL;
$consulta2="SELECT * FROM cupones where codigo_cupon='$n_cupon'";
         if($result=sqlsrv_query($conn, $consulta2)){
   

    $rowsresult=sqlsrv_fetch_array($result);    

$fecha_actual=date('d').date('m').date('Y');
$fecha_operar=$rowsresult['fecha_final'];
$fecha_operar = explode('-',$fecha_operar);




if ($fecha_actual > $fecha_operar and $rowsresult['id_cupon']>0){
  $_SESSION['error2']="LO SENTIMOS, LA FECHA DE VALIDES DEL CUPON NUMERO:".$n_cupon." A CADUCADO";
  	
}else {
  $monto_cupon=$rowsresult['monto_cupon'];
   $_SESSION['id_cupon']=$rowsresult['id_cupon'];
  $operacion1=($total * $monto_cupon)/100;
  $_SESSION['descuento']=$operacion1;
  $_SESSION['error']=NULL;

}


         }
         if ($rowsresult['id_cupon']<1) {
         	 $_SESSION['error']="LO SENTIMOS ESTE CUPON NO EXISTE";
         }
          
          
  
 header("location:../resumenc_compra.php");	

?>