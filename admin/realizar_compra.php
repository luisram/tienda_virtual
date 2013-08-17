<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
require_once('../Connections/tienda.php'); 
$total=$_SESSION['total_compra'];
$id_cliente=$_SESSION['idusuario'];
$compras=$_SESSION['carrito'];
$fecha=date('d')."-".date('m')."-".date('Y');
$ticket="TK".$id_cliente.mt_rand(10000,99999);
 $cuponid=$_SESSION['id_cupon'];//para la ta de cannjeados, id_cupon para los q se van a enviar en base al 10%

//////////////////////////////////////////////////////////////////////////////////
if($_SESSION['carrito']){
	  //

for($i=0;$i<=count($compras)-1;$i++){
	
	if($compras[$i]!=NULL){
	$id_producto=$compras[$i]['id_producto'];
	$cantidad=$compras[$i]['cantidad'];
  sqlsrv_query($conn, "EXEC guardar_compra  @id_cliente = '$id_cliente', @id_producto = '$id_producto', @cantidad = '$cantidad',
   @fecha = '$fecha', @ticket = '$ticket';");

         }

  }
  ///////////////////////////////REGALA UN CUPON DE DESCUENTO SI SUPERA UN LIMITE DE COMPRA///////////////////////////////////////////
   $call_p = "{call query_cupones( ?, ? ,? ,? ,? ,? ,? ,? ,? ,? )}";
 $fecha_final="          ";
 $cantidad_disponible=0;
 $id_cupon=0;
 $codigo_cupon="          ";
 $email="                             ";
 $nombre="                  ";
 $apellido="                  ";
 $monto_cupon="10";
 $regla="     ";



   $parametros = array( 
                 array($fecha_final, SQLSRV_PARAM_OUT),
                 array($cantidad_disponible, SQLSRV_PARAM_OUT),
                 array($id_cupon, SQLSRV_PARAM_OUT),
                 array($codigo_cupon, SQLSRV_PARAM_OUT),
                 array($email, SQLSRV_PARAM_OUT),
                 array($nombre, SQLSRV_PARAM_OUT),
                 array($apellido, SQLSRV_PARAM_OUT),
                 array($regla, SQLSRV_PARAM_OUT),
                 array($monto_cupon, SQLSRV_PARAM_IN),
                 array($id_cliente, SQLSRV_PARAM_IN)
               );


$ejecuta_call_p=sqlsrv_query( $conn, $call_p, $parametros); 

         $nombre_t=strtoupper($apellido).", ".strtoupper($nombre);

//if ($total > $regla and $cantidad_disponible>0) { 
if ($total > $regla) {

  
$pro="INTERCONNECT";
$reci=$email;
$bod="FELICIDADES ".$nombre_t." HA SIDO ACREEDOR DE UN CUPON POR SU COMPRA DE: $".$total." CANJEABLE EN INTERCONNEC EN SU PROXIMA COMPRA INGRESANDO SU NUMERO DE CUPON AL MOMENTO DE REALIZAR SU PAGO. CUPON NUMERO: <BR>".$codigo_cupon."CUPON VALIDO ANTES DE:".$fecha_final;
$sub="PROMOCIONES INTERCONNECT";
$re= sqlsrv_query($conn, "EXEC msdb.dbo.sp_send_dbmail  @profile_name = '$pro', @recipients = '$reci',
   @body = '$bod', @subject = '$sub';");

  $re2= sqlsrv_query($conn, "EXEC guardar_cupones_enviados  @id_cliente = $id_cliente, @cupon = $codigo_cupon;");
         //echo $inser_cupon;


 }
  ///////////////////////////////////////////////////////////////////////////
 ////////////////////////////////////////////////////////////////////////////
  if(isset($_SESSION['descuento'])){
     $re3= sqlsrv_query($conn, "EXEC guardar_canje_cupon  @id_cupon = '$cuponid', @ticket = '$ticket';");
         ////////////////////////////////////////////////////

   
   $_SESSION['descuento']=NULL;
 }else{


    
  } 
//////////////////////////////////////////////////////////


  
  }

$_SESSION['carrito']=NULL;
$total=0;
//header("location:../index.php")
?>