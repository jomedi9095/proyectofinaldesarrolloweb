<?php   
date_default_timezone_set('America/Bogota');
session_start();
require_once "model/data.php";

$d=  new Data();


$proveedorTodos= $d->getProveedor();




$negocio = $d->infonegocio();


foreach ($negocio as $n) {
	$n->id;
	$n->nombre;
	$n->nit;
	$n->direccion;
	$n->celular;
	$n->correo;
	$n->meta;
}

$now=date("Y-m-d");
    list($año, $mes, $dia) = explode('-', $now);
    
  function calculo(){
      $mensaje="";
    $now=date("Y-F-d");
    list($año, $mes, $dia) = explode('-', $now);
    if($mes==01){
$mensaje="$dia - Enero - $año ";

    }elseif($mes=="January"){$mensaje="$dia - Febrero - $año ";}
    elseif($mes=="March"){$mensaje="$dia - Marzo - $año ";}
    elseif($mes=="April"){$mensaje="$dia - Abril - $año ";}
    elseif($mes=="May"){$mensaje="$dia - Mayo - $año ";}
    elseif($mes=="June"){$mensaje="$dia - Junio - $año ";}
    elseif($mes=="July"){$mensaje="$dia - Julio - $año ";}
    elseif($mes=="August"){$mensaje="$dia - Agosto - $año ";}
    elseif($mes=="September"){$mensaje="$dia - Septiembre - $año ";}
    elseif($mes=="October"){$mensaje="$dia - Octubre - $año ";}
    elseif($mes=="November"){$mensaje="$dia - Noviembre - $año ";}
    elseif($mes=="December"){$mensaje="$dia - Diciembre - $año ";}
    

    return $mensaje;
}

$sumaTotal=0;
$sumaFlete=0;
$total=0;


foreach($proveedorTodos as $p){
	list($fechaventas, $horaventa) = explode(" ",$p->fecha);
	list($aniodb, $mesdb, $diadb) = explode("-",$fechaventas);
	if ($mes == $mesdb) {
		$sumaTotal += $p->valorFactura;
		$sumaFlete += $p->flete;}}

$total= $sumaTotal + $sumaFlete;


?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>

<style type="text/css">
*{margin: 0; padding: 0;}
	.todo{
		width: 215.9mm;
		max-width: 215.9mm;
		min-width: 215.9mm;

		padding: 10px 100px;
	}
</style>


<div class="todo">
<h1 class="center"><?php echo $n->nombre; ?></h1>
<h2 class="center">Reporte Mensual Compras</h2>
<h4 class="center"><?php echo calculo(); ?></h4>

<div class="container">

<?php


     echo "<div>";
	echo "<h1>Compras Del Mes</h1>";
echo "<strong>Compras Mes:</strong> ".number_format($sumaTotal,0,"",".");
echo "<br>";
echo "<strong>Fletes Mes:</strong> ".number_format($sumaFlete,0,"",".");
echo "<br>";
echo "<strong>Total Mes:</strong> ".number_format($total,0,"",".");
echo "<table  class='table'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th scope='col'>DESCRIPCION</th>";
	echo "<th scope='col'>FECHA</th>";
	echo "<th scope='col'>VALOR FACTURA</th>";
	echo "<th scope='col'>FLETE</th>";
	echo "<th scope='col'>PROVEEDOR</th>";
	echo "<th scope='col'>MEDIO DE PAGO</th>";

	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";

foreach($proveedorTodos as $pro){
	list($fechaventas, $horaventa) = explode(" ",$pro->fecha);
	list($aniodb, $mesdb, $diadb) = explode("-",$fechaventas);
	if ($mes == $mesdb) {
	
		echo "<tr>";
		echo "<td>".$pro->descripcion."</td>";
		echo "<td>".$pro->fecha."</td>";
		echo "<td>".number_format($pro->valorFactura,0,"",".")."</td>";
		echo "<td>$ ".number_format($pro->flete,0,',','.')."</td>";
		echo "<td>".$pro->proveedor." </td>";
		echo "<td>".$pro->medioPago." </td>";
		echo "</tr>";
		echo "</tbody>";
}}


echo "<tr>";
            echo "<td colspan='3'><strong>TOTAL</strong></td>";
            echo "<td>$ ".number_format($total,0,",",".")."</td>";
    
            echo "<td colspan='1' class=''></td>";
            echo "<td colspan='1' class=''></td>";
			echo "</tr>";
		


          
echo "</table>";


	echo "</div>";

            ?>

    </div>
    <script type="text/javascript">
	function imprimir() {
		if (window.print) {
			window.print();
		} else {
			alert("La función de impresion no esta soportada por su navegador. preciona la CTRL+P para imprimir la factura");
		}
	}
	imprimir();
</script>