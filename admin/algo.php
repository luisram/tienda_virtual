<?php

if( $conn ) { }else{ echo "NO se puede conectar a la Base de Datos.<br />"; die( print_r( sqlsrv_errors(), true)); } $tsql = 'exec nivel_cliente'; /* Execute the query. */ $stmt = sqlsrv_query( $conn, $tsql); if ( $stmt ) { echo "Statement executed.\n"; } else { echo "Error in statement execution.\n"; die( print_r( sqlsrv_errors(), true)); }
/* Iterate through the result set printing a row of data upon each iteration.*/ while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC)) { if ($row[1]>5){ $act = "exec actualizar_clientes ".$row[0].",oro"; $st = sqlsrv_query( $conn, $act); echo "oro:\n"; } elseif ($row[1]>2 and $row[1]<5) { $act = "exec actualizar_clientes ".$row[0].",plata"; $st = sqlsrv_query( $conn, $act); echo "plata:\n"; } else { $act = "exec actualizar_clientes ".$row[0].",bronce"; $st = sqlsrv_query( $conn, $act); echo "Bronce:\n"; }
}
?>
