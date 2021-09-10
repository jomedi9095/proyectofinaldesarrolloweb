<?php 
require_once '../model/data.php';
$d = new Data();
 $id = $_POST ["id"];

$d->deleteProveedor($id);

header ("Location: ../listaProveedor.php");
?>