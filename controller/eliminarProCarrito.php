<?php 
$index = $_GET["in"];
$nom = $_GET["nom"];
$detalleMarca = $_GET["detalle"];
session_start();

if (isset($_SESSION["carrito"])) {
	$carrito = $_SESSION["carrito"];
	unset($carrito[$index]);
	$carrito=array_values($carrito);

	$_SESSION["carrito"]=$carrito;

	if (count($carrito) == 0) {
		unset ($_SESSION['carrito']);
	}
}

header("location: ../carrito.php?action=deleted&nom=$nom &detall= $detalleMarca");

?>