<?php 
session_start();
error_reporting(E_ALL ^ E_NOTICE);
require_once('Connections/tienda.php'); 
 /*
 $call_p = "{call query_cupones( ?, ? ,? ,? ,? ,? ,? ,? ,? )}";
 $fecha_final="          ";
 $cantidad_disponible=0;
 $id_cupon=0;
 $codigo_cupon="          ";
 $email="                             ";
 $nombre="                  ";
 $apellido="                  ";
 $monto_cupon="10";
$id_cliente =1;


   $parametros = array( 
                 array($fecha_final, SQLSRV_PARAM_OUT),
                 array($cantidad_disponible, SQLSRV_PARAM_OUT),
                 array($id_cupon, SQLSRV_PARAM_OUT),
                 array($codigo_cupon, SQLSRV_PARAM_OUT),
                 array($email, SQLSRV_PARAM_OUT),
                 array($nombre, SQLSRV_PARAM_OUT),
                 array($apellido, SQLSRV_PARAM_OUT),
                 array($monto_cupon, SQLSRV_PARAM_IN),
                 array($id_cliente, SQLSRV_PARAM_IN)
               );

/* Execute the query. 
 //$ejecuta_call_p=sqlsrv_query( $conn, $call_p, $parametros);
*/
/*
$ejecuta_call_p=sqlsrv_query( $conn, $call_p, $parametros); 

 echo $fecha_final;
 echo "<br>";
 echo $cantidad_disponible;
 echo "<br>";
 echo $id_cupon;
 echo "<br>";
 echo $codigo_cupon;
 echo "<br>";
 echo $email;
 echo "<br>";
 echo $nombre;
 echo "<br>";
 echo $apellido;
 echo "<br>";
 echo $monto_cupon;
 echo "<br>";
 echo $id_cliente;
*/

 /*
 $re2= sqlsrv_query($conn, "EXEC guardar_cupones_enviados  @id_cliente = '1',
   @id_cupon = '3';");*/
/*
$re3= sqlsrv_query($conn, "EXEC guardar_canje_cupon  @id_cupon = '1',
   @ticket = 'TK23';");*/

/*
$id_cliente=1;
$id_cupon=1;
  $re2= sqlsrv_query($conn, "EXEC guardar_cupones_enviados  @id_cliente = $id_cliente, @id_cupon = $id_cupon;");
*//*
$n_cupon="1532980";
  $call_p = "{call descuento_cupon( ? ,? ,? ,? ,? )}";
 $fecha_final="           ";

 $id_cupon=0;

 $monto_cupon="    ";
 $ctrl=0;


   $parametros = array( 
                 array($id_cupon, SQLSRV_PARAM_OUT),
                 array($monto_cupon, SQLSRV_PARAM_OUT),
                 array($fecha_final, SQLSRV_PARAM_OUT),
                 array($ctrl, SQLSRV_PARAM_OUT),
                 array($n_cupon, SQLSRV_PARAM_IN)
               );
   $ejecuta_call_p=sqlsrv_query( $conn, $call_p, $parametros);  

   echo $id_cupon;
   echo $monto_cupon;
   echo $fecha_final;
   echo $ctrl;*/


   /*
   $cuponid=8;
   $ticket="tr";
    $re3= sqlsrv_query($conn, "EXEC guardar_canje_cupon  @id_cupon = '$cuponid', @ticket = '$ticket';");
    
echo sqlsrv_errors();*//*
$codigo="1111111111111",
$estado="ACTIVO",
$valor="12",
$fecha_inicio="2222222222",
$fecha_final="2222222222",

//$total_disponibles, SQLSRV_PARAM_IN),
 $nombre_cupon="DESCUENTO",

 $tipo_cupon="only",
 $msg="                                         ",
  $ctrl, SQLSRV_PARAM_OUT)
      $DS=1;
         $CD=0;
         $call_p = "{call guardar_cupon( ? ,?, ? ,? ,? ,? ,? ,? ,? ,?,? )}";
 
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
$ejecuta_call_p=sqlsrv_query( $conn, $call_p, $parametros); *//*
  $monto_cupon=0;               
 ///////////////////////////////////////////////////////////////////////////
  $total=503;
 $call_p_2 = "{call calcula_descuento( ? ,? )}";

   $parametros2 = array( 
                 array($total, SQLSRV_PARAM_IN),
                 array($monto_cupon, SQLSRV_PARAM_OUT)
               );


$ejecuta_call_p=sqlsrv_query( $conn, $call_p_2, $parametros2); 
echo $total;
echo $monto_cupon;*/

 $pro="INTERCONNECT";
 
$bod="<html>Confirmaci&oacute;n del env&iacute;o
<h3>   HOLA ".$nombre_t." </h2> 
 <P>Gracias por hacer compras con nosotros. Pensamos que le gustar&iacute;a saber que enviamos su art&iacute;culo, 
 y que esto completa el pedido. Su pedido est&aacute; en camino, y ya no se puede cambiar.</P> 
 DETALLES DEL ENVIO

<hr align='left'size='1' width='800' color='red' noshade>
<table>
<tr>
".$detalle_compra."

</tr>
<tr align='right'>
".$total."

</tr>

</table>

</html>";
$sub="INTERCONNECT";
$re= sqlsrv_query($conn, "EXEC msdb.dbo.sp_send_dbmail  @profile_name = '$pro', @recipients = 'esmeraldakmc@hotmail.com',
   @body = 'hola',@body_format = 'HTML', @subject = '$sub';");
        //echo $inser_cupon;



?>

<html>Confirmaci&oacute;n del env&iacute;o
<h3>   HOLA ".$nombre_t." </h2> 
 <P>Gracias por hacer compras con nosotros. Pensamos que le gustar&iacute;a saber que enviamos su art&iacute;culo, 
 y que esto completa el pedido. Su pedido est&aacute; en camino, y ya no se puede cambiar.</P> 
 DETALLES DEL ENVIO

<hr align='left'size='1' width='800' color='red' noshade>
<table>
<tr>
".$detalle_compra."

</tr>
<tr align='right'>
".$total."

</tr>

</table>

</html>