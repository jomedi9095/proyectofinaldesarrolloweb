<?php
require_once "../model/data.php";
$d = new Data();

$nombre = $_POST["nombre"];
$cantidad = $_POST["cantidad"];
$precio_compra = $_POST["precio_compra"];
$precio_venta=$_POST["precio_venta"];
//$imail=$_POST["imail"];
//$detallesMarca=$_POST["detallesMarca"];
$d->insertarProducto($nombre, $cantidad,$precio_compra, $precio_venta);

header("Location: ../listProductos.php?action=newc&nom=$nombre");
?>