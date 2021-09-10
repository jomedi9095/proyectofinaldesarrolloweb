<?php
session_start();
date_default_timezone_set('America/Bogota');
require_once "model/data.php";
$d = new Data();
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
$total=0;
$ventaId=$_POST["id"];
$clienteCedula=$_POST["cedula"];


$cliente=$d->buscarclientecedula($clienteCedula);

$detalles=$d->getDetalles($ventaId);



$venta=$d->getVenta($ventaId);
foreach ($venta   as   $ve){}

?>

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


<?php if  ($ve->acreditado==0){   ?>
<div class="todo">
	<h1><?php echo $n->nombre; ?></h1><br>
	 <br>
	<p><strong> JOSE MERCADO DIAZ<br>
		<?php echo $n->nit; ?> <br>
	REGIMEN SIMPLIFICADO</strong></p><br>

	<p><strong> ACCESORIOS Y SERVICIO TECNICO</strong><br>
	Ventas al por mayor y detal  <br> 
	 Tu mejor opcion.</p>
	<br>
	<p>*********************************</p>
	<h3>FACTURA DE VENTAS</h3>
	<p>*********************************</p>
	<br>

	<table>
		<tr>
		 <th>#</th>
	<!--	<th>R</th> 
			<th>T</th> -->
			<th>M</th>
			
			<th>D</th>
			<th>V.T</th>
		</tr>
		<?php
		foreach ($detalles as $p) {
			echo "<tr>";
			echo "<td><center>".$p->cantidad."</center></td>";
		//	echo "<td>".$p->detallesMarca."</td>";
		//	echo "<td><center>".$p->imail."</center></td>";
			echo "<td>".$p->nombre."</td>";
		
			echo "<td align='right'>".number_format($p->descuento,0,',','.')."</td>";
            echo "<td align='right'>".number_format($p->subtotal,0,',','.')."</td>";
            
            echo "</tr>";
            
            $total+=$p->subtotal;
		}
		?>
		<tr>
			<td colspan="2" align="center"><strong>TOTAL</strong></td>
			<td>:</td>
			<td align="right"><strong><?php echo "$".number_format($total,0,",","."); ?></strong></td>
		</tr>
	</table>
	
	<br>

	<br>
	<br>
	<span style="display: flex;">
		<p style="text-align: left; width: 50%;">Fecha: <?php echo date("d-m-Y");?></p>
		<p style="text-align: right; width: 50%;"><?php echo "Hora: ".date("h:i:s"); ?></p>
	</span>
	<br>
	<p>ATENDIDO POR: <?php echo $_SESSION["nombre"]; ?></p>
	<br>

	
	<br>
	<p>*********************************</p>
	<h3>CLIENTE</h3>
	<p>*********************************</p>
	<br>
	<p>
		<?php
		foreach ($cliente as $cli) {
			echo $cli->nombre."<br>";
			echo "C.C ".number_format($cli->cedula,0,",",".")."<br>";
			echo $cli->celular." - ".$cli->direccion;
		}
		?>
	</p>
	<br>
	<p>*********************************</p>
	<p><strong> <?php  echo $n->direccion  ?> <br>
		Cels. <?php echo $n->celular ?> <br>
		CHINU - CORDOBA</strong> <br>
	</p>
</div>
    <?php }  else {?>


        <div class="todo">
	<h1><?php echo $n->nombre; ?></h1><br>
	<h1>TIENDA</h1> <br>
	<p><strong> ANDREINA SIERRA GUZMAN<br>
		<?php echo $n->nit; ?> <br>
	REGIMEN SIMPLIFICADO</strong></p><br>

	<p><strong> DISTRIBUIDORA DE MERCANCIA </strong><br>
	Ventas al por mayor y detal  <br> 
	 Tu mejor opcion.</p>
	<br>
	<p>*********************************</p>
	<h3>FACTURA DE VENTAS</h3>
	<p>*********************************</p>
	<br>

	<table>
		<tr>
		<th>#</th>
	<!--	<th>R</th>
			<th>T</th> -->
			<th>M</th>
			
			<th>D</th>
			<th>V.T</th>
		</tr>
		<?php
		foreach ($detalles as $p) {
			echo "<tr>";
			echo "<td><center>".$p->cantidad."</center></td>";
			//echo "<td>".$p->detallesMarca."</td>";
			//echo "<td><center>".$p->imail."</center></td>";
			echo "<td>".$p->nombre."</td>";
			
			echo "<td align='right'>".number_format($p->descuento,0,',','.')."</td>";
			echo "<td align='right'>".number_format($p->subtotal,0,',','.')."</td>";
            echo "</tr>";
            
            $total+=$p->subtotal;
		}
		?>
		<tr>
			<td colspan="2" align="center"><strong>TOTAL</strong></td>
			<td>:</td>
			<td align="right"><strong><?php echo "$".number_format($total,0,",","."); ?></strong></td>
		</tr>
	</table>
	
	<br>
	<?php
	
		echo "Acreditado total: $ ".number_format($total,0,',','.');
	
	?>
	<br>
	<br>
	<span style="display: flex;">
		<p style="text-align: left; width: 50%;">Fecha: <?php echo date("d-m-Y");?></p>
		<p style="text-align: right; width: 50%;"><?php echo "Hora: ".date("h:i:s"); ?></p>
	</span>
	<br>
	<p>ATENDIDO POR: <?php echo $_SESSION["nombre"]; ?></p>
	<br>
	
	<br>
	<p>*********************************</p>
	<h3>CLIENTE</h3>
	<p>*********************************</p>
	<br>
	<p>
		<?php
		foreach ($cliente as $cli) {
			echo $cli->nombre."<br>";
			echo "C.C ".number_format($cli->cedula,0,",",".")."<br>";
			echo $cli->celular." - ".$cli->direccion;
		}
		?>
	</p>
	<br>
	<p>*********************************</p>
	<p><strong> <?php  echo $n->direccion  ?> <br>
		Cels. <?php echo $n->celular ?> <br>
		CHINU - CORDOBA</strong> <br>
	</p>
</div>

        <?php } ?>

<style type="text/css">
*{ padding: 0;margin: 0;font-size: 8pt;}
.todo{
	width: 199px;
	max-width: 199px;
	padding:10px;
	display: block;
}
h1{
	font-size: 18pt;
	text-align: center;
}
h3{
	text-align: center;
}
p{
	text-align: center;
}
table{
	width: 200px;
	max-width: 219.2125984252px;
}
</style>


