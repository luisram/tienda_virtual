<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
require_once('../Connections/tienda.php'); 
$nombre_cupon=$_SESSION['nombre_cupon'];
$codigo=$_SESSION['codigo'];
$estado=$_SESSION['estado'];
$fecha_inicio=$_SESSION["dia1"]."-".$_SESSION["mes1"]."-".$_SESSION["anio1"];
$fecha_final=$_SESSION["dia2"]."-".$_SESSION["mes2"]."-".$_SESSION["anio2"];
$total_disponibles=$_SESSION['total_disponibles'];
$valor=$_SESSION['valor'];
$id_cliente=$_SESSION['id'];
$tipo_cupon=$_SESSION['tipo_cupon'];

//echo $valor;
//echo $total_disponibles;
if ($id_cliente!=0) {
	$Q_cliente="SELECT * FROM cliente";
         $result_Q_cliente=sqlsrv_query($conn, $Q_cliente) or die (sqlsrv_errors());
              
        $rowsresult_Q_cliente=sqlsrv_fetch_array($result_Q_cliente); 
        $nombre=strtoupper($rowsresult_Q_cliente['apellido']).", ".strtoupper($rowsresult_Q_cliente['nombre']);

$pro="INTERCONNECT";
$reci=$rowsresult_Q_cliente['email'];
$bod="FELICIDADES ".$nombre." HA SIDO ACREEDOR DE UN CUPON CANJEABLE EN INTERCONNEC EN SU PROXIMA COMPRA INGRESANDO SU NUMERO DE CUPON AL MOMENTO DE REALIZAR SU PAGO. CUPON NUMERO: <BR>".$codigo."CUPON VALIDO ANTES DE:".$fecha_final;
$sub="PROMOCIONES INTERCONNECT";
$re= sqlsrv_query($conn, "EXEC msdb.dbo.sp_send_dbmail  @profile_name = '$pro',
   @recipients = '$reci',
   @body = '$bod',
   @subject = '$sub';");

 $re2= sqlsrv_query($conn, "EXEC guardar_cupones_enviados  @id_cliente = $id_cliente, @cupon = $codigo;");
 
         $DS=1;
         $CD=0;
         $consulta4="INSERT INTO cupones (codigo_cupon,estado_cupon,monto_cupon,fecha_inicio,fecha_final,cantidad_disponible,nombre,cantidad_canje,tipo_cupon) 
 VALUES ('$codigo','$estado','$valor','$fecha_inicio','$fecha_final','$CD','$nombre_cupon','$DS','$tipo_cupon')";
         sqlsrv_query($conn, $consulta4) or die (sqlsrv_errors());

}else
{

$consulta="INSERT INTO cupones (codigo_cupon,estado_cupon,monto_cupon,fecha_inicio,fecha_final,cantidad_disponible,nombre,cantidad_canje,tipo_cupon) 
 VALUES ('$codigo','$estado','$valor','$fecha_inicio','$fecha_final','$total_disponibles','$nombre_cupon','$total_disponibles','$tipo_cupon')";
         sqlsrv_query($conn, $consulta) or die (sqlsrv_errors());


}


         $_SESSION['id']=0;
         $_SESSION['valor']="";
         $_SESSION['total_disponibles']="";
         $_SESSION['codigo']="";
         $_SESSION['nombre_cupon']="";
        // header("location:cupones.php");
//
?>