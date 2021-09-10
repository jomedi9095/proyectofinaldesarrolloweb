<?php
require_once "../model/data.php";
$d = new Data();

$descripcion = $_POST["descripcion"];
$valorFactura = $_POST["valorFactura"];
$flete = $_POST["flete"];
$proveedor=$_POST["proveedor"];
$medioPago=$_POST["medioPago"];

$d->insertarProveedor($descripcion,$valorFactura,$flete,$proveedor,$medioPago);

header("Location: ../listaProveedor.php?action=newp&nom=$descripcion");
?>