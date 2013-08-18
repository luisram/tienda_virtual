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
$bod="<html><h2><font color=red><b>FELICIDADES</b></font></h2><h3><br> ".$nombre." HA SIDO ACREEDOR DE UN CUPON CANJEABLE EN INTERCONNEC EN SU PROXIMA COMPRA INGRESANDO SU NUMERO DE CUPON AL MOMENTO DE REALIZAR SU PAGO. CUPON NUMERO: <font color=red><b>".$codigo."</b></font> CUPON VALIDO ANTES DE:".$fecha_final."</h3></html>";
$sub="PROMOCIONES INTERCONNECT";
$re= sqlsrv_query($conn, "EXEC msdb.dbo.sp_send_dbmail  @profile_name = '$pro',
   @recipients = '$reci',
   @body = '$bod',
   @body_format = 'HTML';
   @subject = '$sub';");

 $re2= sqlsrv_query($conn, "EXEC guardar_cupones_enviados  @id_cliente = $id_cliente, @cupon = $codigo;");
 
         $DS=1;
         $CD=0;
         $call_p = "{call guardar_cupon( ? ,?, ? ,? ,? ,? ,? ,? ,? ,?,? )}";
 $msg="                                             ";
 $ctrl=0;   
    $parametros = array( 
                 array($codigo, SQLSRV_PARAM_IN),
                 array($estado, SQLSRV_PARAM_IN),
                 array($valor, SQLSRV_PARAM_IN),
                 array($fecha_inicio, SQLSRV_PARAM_IN),
                 array($fecha_final, SQLSRV_PARAM_IN),
                 array($CD, SQLSRV_PARAM_IN),
                 array($nombre_cupon, SQLSRV_PARAM_IN),
                 array($DS, SQLSRV_PARAM_IN),
                 array($tipo_cupon, SQLSRV_PARAM_IN),
                 array($msg, SQLSRV_PARAM_OUT),
                 array($ctrl, SQLSRV_PARAM_OUT)
               );
$ejecuta_call_p=sqlsrv_query( $conn, $call_p, $parametros); 
/* Execute the query. 
 //$ejecuta_call_p=sqlsrv_query( $conn, $call_p, $parametros);
*/
/*

         $consulta4="INSERT INTO cupones (codigo_cupon,estado_cupon,monto_cupon,fecha_inicio,fecha_final,cantidad_disponible,nombre,cantidad_canje,tipo_cupon) 
 VALUES ('$codigo','$estado','$valor','$fecha_inicio','$fecha_final','$CD','$nombre_cupon','$DS','$tipo_cupon')";
         sqlsrv_query($conn, $consulta4) or die (sqlsrv_errors());
*/
}else
{
 $call_p = "{call guardar_cupon( ? ,?, ? ,? ,? ,? ,? ,? ,? ,?,? )}";
 $msg="                                             ";
 $ctrl=0;   
    $parametros2 = array( 
                 array($codigo, SQLSRV_PARAM_IN),
                 array($estado, SQLSRV_PARAM_IN),
                 array($valor, SQLSRV_PARAM_IN),
                 array($fecha_inicio, SQLSRV_PARAM_IN),
                 array($fecha_final, SQLSRV_PARAM_IN),
                 array($total_disponibles, SQLSRV_PARAM_IN),
                 array($nombre_cupon, SQLSRV_PARAM_IN),
                 array($total_disponibles, SQLSRV_PARAM_IN),
                 array($tipo_cupon, SQLSRV_PARAM_IN),
                 array($msg, SQLSRV_PARAM_OUT),
                 array($ctrl, SQLSRV_PARAM_OUT)
               );
$ejecuta_call_p=sqlsrv_query( $conn, $call_p, $parametros2); /*
$consulta="INSERT INTO cupones (codigo_cupon,estado_cupon,monto_cupon,fecha_inicio,fecha_final,cantidad_disponible,nombre,cantidad_canje,tipo_cupon) 
 VALUES ('$codigo','$estado','$valor','$fecha_inicio','$fecha_final','$total_disponibles','$nombre_cupon','$total_disponibles','$tipo_cupon')";
         sqlsrv_query($conn, $consulta) or die (sqlsrv_errors());
*/

}


         $_SESSION['id']=0;
         $_SESSION['valor']="";
         $_SESSION['total_disponibles']="";
         $_SESSION['codigo']="";
         $_SESSION['nombre_cupon']="";
         header("location:cupones.php");
//
?>