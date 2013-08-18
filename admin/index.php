<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<title>
</title>

<head>
	<title>INTERCONNECT</title>

<link href="../css/estilo-admin.css" type="text/css" rel="stylesheet" media="all" />
</head>
<body>
	<form>
    <div id="total">
  <div id="contenido">
        <div id="cabecera">
            <div id="nav">
    <ul class="mi-menu">
  <li><a href="index.php"> Inicio </a></li>
  <li>
    <a href="#"> Promociones </a>
    <ul>
      <li><a href="cupones.php"> Cupones </a></li>
        
    </ul>
        
    </ul>
  </li>

</ul>
</div>
</div>
<!--CONTENIDO AQUI-->
 <form name="form1" method="post" action="">
   
      <?php
      include "libchart/classes/libchart.php";
require_once('../Connections/tienda.php'); 
$call_p = "{call stats_cupones( ?, ? )}";
$cupon_canjed=0;
$cupon_send=0;
$cupon_no_cangeado=($cupon_send-$cupon_canjed);
   $parametros = array( 
                 array($cupon_send, SQLSRV_PARAM_OUT),
                 array($cupon_canjed, SQLSRV_PARAM_OUT)
               );


$ejecuta_call_p=sqlsrv_query( $conn, $call_p, $parametros); 

$cupon_no_cangeado=($cupon_send-$cupon_canjed);
  $chart = new PieChart();

  $dataSet = new XYDataSet();
  $dataSet->addPoint(new Point("CUPONES CANJEADOS ".$cupon_canjed, $cupon_canjed));
 
    $dataSet->addPoint(new Point("CUPONES SIN CANJEAR ".$cupon_no_cangeado, $cupon_no_cangeado));
   
  $chart->setDataSet($dataSet);

  $chart->setTitle("ESTADISTICA DE CUPONES, ENVIADOS".$cupon_send);
  $chart->render("stats_cupones.png");
  echo "<IMG SRC='stats_cupones.png'>";
/////////////////////////////////////////////////////////////////////////////////////////////
  $consulta=sqlsrv_query($conn,"Select Top 5 c.id_producto,p.nombre,  sum(c.cantidad) AS ventas 
from   compra as c, producto as p where p.id_producto = c.id_producto
Group by c.id_producto,p.nombre ORDER BY ventas DESC");
  $i=0;

  $chart = new VerticalBarChart(500, 250);
   $dataSet = new XYDataSet();
  while($row=sqlsrv_fetch_array($consulta))
  {

 $dataSet->addPoint(new Point($row['nombre'], $row['ventas']));
 
 

  $i=$i+1;
}
 $chart->setDataSet($dataSet);
  $chart->setTitle("PRODUCTOS MAS RENTABLES");
 $chart->render("demo1.png");
  echo "<IMG SRC='demo1.png'>";
      ?> </form>
</div>
</div>
</form>
</body>
</html>
