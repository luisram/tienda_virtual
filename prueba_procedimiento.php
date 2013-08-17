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
   $cuponid=8;
   $ticket="tr";
    $re3= sqlsrv_query($conn, "EXEC guardar_canje_cupon  @id_cupon = '$cuponid', @ticket = '$ticket';");
    
echo sqlsrv_errors();

?>

