<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "glamurosa";
$conn = new mysqli('127.0.0.1', 'root', '', 'glamurosa');
$sql = "SELECT nombre FROM clientes c, creditos v WHERE c.cedula=v.cliente AND nombre LIKE '%".$_GET['query']."%' LIMIT 20";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$json = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {
$json[] = $rows["nombre"];
}
echo json_encode($json);
?>

