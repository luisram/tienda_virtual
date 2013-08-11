<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
require_once('../Connections/tienda.php'); 
$total=$_SESSION['total_compra'];
$id_cliente=$_SESSION['idusuario'];
$compras=$_SESSION['carrito'];
$fecha=date('d')."-".date('m')."-".date('Y');
$ticket="TK".$id_cliente.mt_rand(10000,99999);
 $id_cupon=$_SESSION['id_cupon'];

//////////////////////////////////////////////////////////////////////////////////
if($_SESSION['carrito']){
	  //

for($i=0;$i<=count($compras)-1;$i++){
	
	if($compras[$i]!=NULL){
	$id_producto=$compras[$i]['id_producto'];
	$cantidad=$compras[$i]['cantidad'];
	

  $consulta="INSERT INTO compra (id_cliente,id_producto,cantidad,fecha,id_ticket) 
 VALUES ('$id_cliente','$id_producto','$cantidad','$fecha','$ticket')";
         sqlsrv_query($conn, $consulta) or die (sqlsrv_errors());

         }

  }
  ///////////////////////////////REGALA UN CUPON DE DESCUENTO SI SUPERA UN LIMITE DE COMPRA///////////////////////////////////////////
   $Q_asig_cupon="SELECT cup.fecha_final,cup.cantidad_disponible,cup.id_cupon,cup.codigo_cupon,cup.monto_cupon,cli.email,cli.nombre FROM cupones as cup, cliente as cli where monto_cupon='10' and estado_cupon='activo'and cli.id_cliente= '1'";
         $result_asig_cupon=sqlsrv_query($conn, $Q_asig_cupon) or die (sqlsrv_errors());
              
        $rowsresult_asig_cupon=sqlsrv_fetch_array($result_asig_cupon); 

         $Q_cliente="SELECT * FROM cliente";
         $result_Q_cliente=sqlsrv_query($conn, $Q_cliente) or die (sqlsrv_errors());
              
        $rowsresult_Q_cliente=sqlsrv_fetch_array($result_Q_cliente); 
        $nombre=strtoupper($rowsresult_Q_cliente['apellido']).", ".strtoupper($rowsresult_Q_cliente['nombre']);
       // echo $total;
       
if ($total > 500 and $rowsresult_asig_cupon['cantidad_disponible']>0) {
  $id_cupon = $rowsresult_asig_cupon['id_cupon'];
  $cupon =$rowsresult_asig_cupon['codigo_cupon'];
  $fecha_final=$rowsresult_asig_cupon['fecha_final'];


$pro="INTERCONNECT";
$reci=$rowsresult_Q_cliente['email'];
$bod="FELICIDADES ".$nombre." HA SIDO ACREEDOR DE UN CUPON POR SU COMPRA DE: $".$total." CANJEABLE EN INTERCONNEC EN SU PROXIMA COMPRA INGRESANDO SU NUMERO DE CUPON AL MOMENTO DE REALIZAR SU PAGO. CUPON NUMERO: <BR>".$cupon."CUPON VALIDO ANTES DE:".$fecha_final;
$sub="PROMOCIONES INTERCONNECT";
$re= sqlsrv_query($conn, "EXEC msdb.dbo.sp_send_dbmail  @profile_name = '$pro',
   @recipients = '$reci',
   @body = '$bod',
   @subject = '$sub';");

  $inser_cupon="INSERT INTO cupones_enviados (id_cliente, id_cupon) 
 VALUES ('$id_cliente','$cupon')";
         sqlsrv_query($conn, $inser_cupon) or die (sqlsrv_errors());
         //echo $inser_cupon;


 }

  ////////////////////////////////
  if(isset($_SESSION['descuento'])){
     $consulta2="INSERT INTO canje_cupon (id_cupon,ticket) 
 VALUES ('$id_cupon','$ticket')";
         sqlsrv_query($conn, $consulta2) or die (sqlsrv_errors());
         ////////////////////////////////////////////////////
         $consulta3="SELECT cantidad_disponible FROM cupones where id_cupon='$id_cupon'";
         $result=sqlsrv_query($conn, $consulta3) or die (sqlsrv_errors());
              
        $rowsresult=sqlsrv_fetch_array($result); 
        $cantidad2=$rowsresult['cantidad_disponible'];
        $cantidad_updated=$cantidad2-1;     
         ////////////////////////////////////////////////////
         $consulta4 = "UPDATE cupones SET cantidad_disponible = '$id_cupon' 
WHERE id_cupon = '$id_cupon'";
sqlsrv_query($conn, $consulta4) or die (sqlsrv_errors());
   
   $_SESSION['descuento']=NULL;
 }else{


    
  } 
//////////////////////////////////////////////////////////


  
  }
/*
$consulta="INSERT INTO cupones (codigo_cupon,estado_cupon,monto_cupon,fecha_inicio,fecha_final,cantidad_disponible,nombre) 
 VALUES ('$codigo','$estado','$valor','$fecha_inicio','$fecha_final','$total_disponibles','$nombre_cupon')";
         sqlsrv_query($conn, $consulta) or die (sqlsrv_errors());

*/
$_SESSION['carrito']=NULL;
$total=0;
header("location:../index.php")
?>