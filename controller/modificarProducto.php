<?php
require_once "../model/data.php";
$d = new Data();

$id = $_POST["id"];
//$referencia=$_POST["referencia"];
$nombre = $_POST["nombre"];
$cantidad = $_POST["cantidad"];
$precio_compra = $_POST["precio_compra"];
$precio_venta = $_POST["precio_venta"];
//$imail=$_POST["imail"];
//$detallesMarca=$_POST["detallesMarca"];

$d->actualizar_producto($id, $nombre, $cantidad, $precio_compra, $precio_venta);

header("Location: ../listProductos.php?action=actu&nom=$nombre");

?>