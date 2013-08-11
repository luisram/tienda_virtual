<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

/*
$hostname_tienda = "tu_host";
$database_tienda = "nombre_base_de_datos";
$username_tienda = "usuario_base_de_datos";
$password_tienda = "password_usuario";
$tienda = mysql_pconnect($hostname_tienda, $username_tienda, $password_tienda) or trigger_error(mysql_error(),E_USER_ERROR); 
*/

$serverName = "JADE-PC"; 
$database_tienda="mainbd";
$connectionInfo = array( "Database"=>"mainbd"); 
$conn = sqlsrv_connect( $serverName, $connectionInfo); 

if( $conn ) { 
     
}else{ 
     echo "NO se puede conectar a la Base de Datos.<br />"; 
     die( print_r( sqlsrv_errors(), true)); }?>