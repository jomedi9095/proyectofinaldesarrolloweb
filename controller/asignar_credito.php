<?php
require_once "../model/data.php";
$d = new Data();

$cliente = $_POST["cliente"];

$cajero = $_POST["cajero"];

$d->realizarcredito($cliente, $cajero);

header("Location: ../listaClientes.php");

?>