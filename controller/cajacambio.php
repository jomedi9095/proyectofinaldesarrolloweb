<?php
session_start();
if (isset($_POST["efectivo"])) {
	$efectivo = $_POST["efectivo"];
	
}
$total = $_SESSION["total"];


if($efectivo==0){

echo "<h2>  Ingrese El Efectivo  </h2>";

}

if($efectivo<$total){

    echo "<h2>  !De No Ser Así Ingrese El Efectivo¡   </h2>";

}

else {

    $cambio = $efectivo - $total;
echo "<h2>$ ".number_format($cambio,0,',','.')."</h2>";}

?>