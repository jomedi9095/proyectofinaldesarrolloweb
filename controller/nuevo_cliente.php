<?php
require_once "../model/data.php";
$d = new Data();

$nombre = $_POST["nombre"];
$cedula = $_POST["cedula"];
$direccion = $_POST["direccion"];
$celular = $_POST["celular"];
$correo = $_POST ["correo"];


$asunto="Cliente Nuevo En Glamurosa & Gusi";
$mensaje="Hola eres un nuevo cliente registrado en el Software De La Empresa Glamurosa & Gusi
Cedula: $cedula  
Nombres: $nombre
Direccion: $direccion 
Celular: $celular";
$headers .= "From: Glamurosa & Gusi <jedastudiocode@gmail.com>\r\n";
mail($correo,$asunto,$mensaje,$headers);



$d->insertcliente($nombre, $cedula,$correo, $direccion, $celular);

header("Location: ../listaClientes.php?action=newc&nom=$nombre");
?>