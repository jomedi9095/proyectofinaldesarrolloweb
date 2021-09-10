<?php   
date_default_timezone_set('America/Bogota');
session_start();
require_once "model/data.php";

$d=  new Data();
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

$proveedorHoy= $d->getProveedorHoy();

$sumaHoy=0;
$sumaFlete=0;
$totalHoy=0;
foreach ($proveedorHoy as $pl) {
$sumaFlete += $pl->flete;
$sumaHoy += $pl->valorFactura;
}

$totalHoy= $sumaHoy + $sumaFlete;


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
<!--

<style type="text/css">
 @media print {
     html,body{
        font-size: 9.5pt;
        margin: 0;
        padding: 0;
     }.page-break {
       page-break-before:always;
       width: auto;
       margin: auto;
      }
    }
    .page-break{
      width: 980px;
      margin: 0 auto;
    }
     .sale-head{
       margin: 40px 0;
       text-align: center;
     }.sale-head h1,.sale-head strong{
       padding: 10px 20px;
       display: block;
     }.sale-head h1{
       margin: 0;
       border-bottom: 1px solid #212121;
     }.table>thead:first-child>tr:first-child>th{
       border-top: 1px solid #000;
      }
      table thead tr th {
       text-align: center;
       border: 1px solid #ededed;
     }table tbody tr td{
       vertical-align: middle;
     }.sale-head,table.table thead tr th,table tbody tr td,table tfoot tr td{
       border: 1px solid #212121;
       white-space: nowrap;
     }.sale-head h1,table thead tr th,table tfoot tr td{
       background-color: #f8f8f8;
     }tfoot{
       color:#000;
       text-transform: uppercase;
       font-weight: 500;
     }
</style>
    -->

<div class="todo">
<h1 class="center"><?php echo $n->nombre; ?></h1>
<h2 class="center">Reporte Diario Compras</h2>
<h4 class="center"><?php echo date("Y-m-d"); ?></h4>

<div class="container">
		<?php 
		echo "<div>";
		echo "<br>";
		echo "<strong>Compras Hoy:</strong> $ ".number_format($sumaHoy,0,",",".");
		echo "<br>";
		echo "<strong>Fletes Hoy: </strong>$ ".number_format($sumaFlete,0,",",".");
        echo "<br>";
		echo "<strong>Total: </strong>$ ".number_format($totalHoy,0,",",".");
        echo "<table  class='table'>";
        echo "<thead>";
		echo "<tr>";
		echo "<th>DESCRIPCION</th>";
		echo "<th>FECHA</th>";
		echo "<th>VALOR FACTURA</th>";
		echo "<th>FLETE</th>";
		echo "<th>PROVEEDOR</th>";
        echo "<th>MEDIO PAGO</th>";
        echo "</tr>";
        echo "</thead>";
        $i=0;
         echo "<tbody>";
		foreach ($proveedorHoy as $p) {
			echo "<tr>";
			echo "<td>".$p->descripcion."</td>";
			echo "<td>".$p->fecha."</td>";
			echo "<td>$".number_format($p->valorFactura,0,"",".")."</td>";
			echo "<td>$ ".number_format($p->flete,0,',','.')."</td>";
			echo "<td>".$p->proveedor."</td>";
			echo "<td>".$p->medioPago."</td>";
            
            
            echo "</tr>";
            echo "</tbody>";
           
        } 
            echo "<tr>";
            echo "<td colspan='3'> <strong>TOTAL </strong></td>";

            echo "<td>$ ".number_format($totalHoy,0,",",".")."</td>";
          
        
            echo "</tr>";

echo "</tr>";

          
        echo "</table>"; ?>

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