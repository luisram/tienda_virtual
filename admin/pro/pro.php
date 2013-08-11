<?php
require_once('../../Connections/tienda.php'); 
$pro="Luis Aguilar";
$reci="esmeraldakmc@hotmail.com";
$bod="ahora si de verdad esta mucho mas mejor";
$sub="INTERCONNECT INC";
$re= sqlsrv_query($conn, "EXEC msdb.dbo.sp_send_dbmail  @profile_name = '$pro',
   @recipients = '$reci',
   @body = '$bod',
   @subject = '$sub';");
//sqlsrv_execute($re);
?>