<?php 
require_once "../model/data.php";
session_start();
if (isset($_POST["efectivoPrueba"])) {
	$efectivo = $_POST["efectivoPrueba"];
	$_SESSION["efectivoPrueba"] = $efectivo;
}


$carrito = $_SESSION["carrito"];
$total = $_SESSION["total"];
if (isset($_POST["cliensear"])) {
	$_SESSION["clienteventa"]=$_POST["cliensear"];
}

$d = new Data();
$cliente = $d->buscarcliente($_SESSION["clienteventa"]);

foreach ($cliente as $cli) {
	$cli->id;
	$cli->nombre;
	$cli->cedula;
	$cli->celular;
	$cli->direccion;
}
?>
 <?php
if ($efectivo >=$total){

	$d->crear_venta($carrito, $total, $cli->cedula); ?>
	<script type="text/javascript">
	var opciones = "width=600, height=620, scrollbars=NO, top=0";
	window.open("../facturaCredito.php","nombreventa na", opciones);

// redirigir la pestaña actual a otra URL
window.location.href = 'http://localhost/ERCEL'; 
</script> 

  <?php } ?>
  <?php
if ($efectivo <$total) {
	header("Location: ../carrito.php?mensaje=falso");


}?>




