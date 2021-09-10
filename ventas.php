<?php   
date_default_timezone_set('America/Bogota');
session_start();
require_once "model/data.php";

$d=  new Data();

$ventasHoy=$d->ventasHoy();
 $totalHoy=0;
 $acreditadoHoy=0;
foreach($ventasHoy as $venta){
$totalHoy+=$venta->total;
$acreditadoHoy+= $venta->acreditado;

}

$totalVentas=$d->totalVentas();







$egresosHoy=$d->getEgresoshoy();
$egreHoy=0;



foreach($egresosHoy as $egre){
$egreHoy+=$egre->valor;

}

$abonosHoy=$d->getAbonadoHoy();
$abonadoHoy=0;
foreach ($abonosHoy as $abo){
$abonadoHoy+=$abo->abono;

}

$sumandos=$totalHoy+$abonadoHoy;


$now=date("Y-m-d");
	list($año, $mes, $dia) = explode('-', $now);


$utilidad=$d->getUtilidadHoy();

$utilidadMes=$d->getUtilidad();

$subtotalCompra=0;
$totalCompra=0;
foreach ($utilidad as $uti){
$subtotalCompra=$uti->precio_compra*$uti->cantidad;
$totalCompra+=$subtotalCompra;

}

include 'header.php';
?>    

<script type="text/javascript">
	

		function mostrarcon(){
			
				document.getElementById('hoy').style.display = 'none';
				document.getElementById('siempre').style.display = 'inline';
			
		}
		function mostrarhoy(){
			document.getElementById('siempre').style.display = 'none';
			document.getElementById('hoy').style.display = 'inline';
		}
	</script>


<div class="container">
<center><a  class='btn btn-success   ' type='submit' href='historialVentas.php' ><i class="fas fa-clipboard"></i> Historial De Ventas </a></center>
		<?php 
		echo "<div id='hoy'>";
		echo "<h1>Ventas del día</h1>";
		echo "<strong>Fecha:</strong> ".$now;
		echo "<br>";
		echo "<strong>Ventas de hoy:</strong> $ ".number_format($totalHoy,0,",",".");
		echo "<br>";
		echo "<strong>Créditos: </strong>$ ".number_format($acreditadoHoy,0,",",".");
		echo "<br>";
		echo "<strong>Egresos: </strong>$ ".number_format($egreHoy,0,",",".");
		echo "<br>";
		echo "<strong>Abonado: </strong>$ ".number_format($abonadoHoy,0,",",".");
		echo "<br>";
		echo "<strong>Total en caja:</strong> $ ".number_format($sumandos - $acreditadoHoy - $egreHoy,0,",",".");
		echo "<br>";
		echo "<strong>Utilidad de hoy:</strong> $ ".number_format($totalHoy-$totalCompra,0,",","."); 
		//echo "<span style='display:block; text-align: center;'><button class='btn-flat waves-effect' onclick='imprimirreporte()'>Imprimir reporte</button></span>";
	echo	"  <br> <br> <span style='display:block; text-align: center;'><button onclick='imprimirreporte()' class='btn btn-primary'><i class='fas fa-download fa-sm text-white-50'></i> Generar Reporte Diario</button></span>";
		echo "<span style='display:block; width:100%; text-align: right;'><button class='acceuno waves-effect waves-yellow btn-flat btn' href='#' onclick='mostrarcon()'>→ Ver Historial Del Mes</button></span>";
	  
		echo  "<div class='card-body'> ";
echo "  <div class='table-responsive'>";
		
		echo "<table  class='table'>";
        echo "<thead>";
		echo "<tr>";
		echo "<th scope='col'>ID</th>";
		echo "<th scope='col'>FECHA</th>";
		echo "<th scope='col'>CÉDULA CLIENTE</th>";
		echo "<th scope='col'>TOTAL</th>";
		echo "<th scope='col'>ACREDITADO</th>";
		echo "<th scope='col'>DETALLES</th>";
		echo "<th scope='col'>FACTURA</th>";
	
        echo "</tr>";
        echo "</thead>";
        $i=0;
		 echo "<tbody>";
		 
		 
		foreach ($ventasHoy as $ve) {


			echo "<tr>";
			echo "<td>".$ve->id."</td>";
			echo "<td>".$ve->fecha."</td>";
			echo "<td>".number_format($ve->cliente,0,"",".")."</td>";
			echo "<td>$ ".number_format($ve->total,0,',','.')."</td>";
			echo "<td>$ ".number_format($ve->acreditado,0,',','.')."</td>";
			echo "<td class='center'>";
			echo "<a href='detalles.php?id=".$ve->id."'>Ver detalles</a>";
			echo "</td>";
			
			echo "<td class='center'>";
			echo "<button class='btn btn-danger btn-icon-split'   data-toggle='modal' data-target='#exampleModalFactura".$ve->id."'> <i class='fas fa-file-invoice'></i></button>";
			echo "</td>";


            echo "</tr>";
			echo "</tbody>";
			
$clientes=$d->buscarclientecedula($ve->cliente);
foreach ($clientes as $cli){
		echo	"<div class='modal fade' id='exampleModalFactura".$ve->id."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
              <div class='modal-content'>
                <form action='recuperarFactura.php' method='post'>
                  <div class='modal-header'>
                    <h5 class='modal-title' id='exampleModalLabel'> Factura De: $cli->nombre</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button>
                  </div>

                  <div class='modal-body'>
                    <input type='hidden' name='id' value= '" .$ve->id."'>
					<input type='hidden' name='cedula' value= '" .$ve->cliente."'>
                    <div class='modal-footer'>
                      <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                      <button name='action'   id='action' type='submit' class='btn btn-primary'>Generar Factura</button>
                    </div>
                  </div>
              </div>
              </form>
            </div>
			</div>";
           
		  }  } 
            echo "<tr>";
            echo "<td colspan='3'>Total</td>";
            echo "<td>$ ".number_format($totalHoy,0,",",".")."</td>";
            echo "<td>$ ".number_format($acreditadoHoy,0,",",".")."</td>";
            echo "<td colspan='1' class=''></td>";
            echo "<td colspan='1' class=''></td>";
            echo "</tr>";

			

		echo "</table>";
		echo "</div>";
		echo "</div>";

echo "</div>";

$sumaTotal=0;
$sumaCreditos=0;
$egresosMes=0;

$egresos=$d->getEgresos();

foreach($egresos as $e){
	list($fechaventas, $horaventa) = explode(" ",$e->fecha);
	list($aniodb, $mesdb, $diadb) = explode("-",$fechaventas);
	if ($mes == $mesdb) {
$egresosMes += $e->valor;
	}
}


foreach($totalVentas as $ven){
	list($fechaventas, $horaventa) = explode(" ",$ven->fecha);
	list($aniodb, $mesdb, $diadb) = explode("-",$fechaventas);
	if ($mes == $mesdb) {
		$sumaTotal+=$ven->total;
		$sumaCreditos+=$ven->acreditado;}}

$sumaAbonos=0;
		$abonos=$d->getAbonado();
foreach($abonos as $abo){
	list($fechaventas, $horaventa) = explode(" ",$abo->fecha_abono);
	list($aniodb, $mesdb, $diadb) = explode("-",$fechaventas);
	if ($mes == $mesdb) {
$sumaAbonos+=$abo->abono;

	}
}

$subtotalCompraMes=0;
$totalCompraMes=0;
foreach ($utilidadMes as $uti){
	list($fechaventas, $horaventa) = explode(" ",$uti->fecha);
	list($aniodb, $mesdb, $diadb) = explode("-",$fechaventas);
	if ($mes == $mesdb) {
$subtotalCompraMes=$uti->precio_compra*$uti->cantidad;
$totalCompraMes+=$subtotalCompraMes;
	}
}


     echo "<div id='siempre' style='display:none;'>";
	echo "<h1>Ventas Del Mes</h1>";
echo "<strong>Total Mes:</strong>$ ".number_format($sumaTotal,0,"",".");
echo "<br>";
echo "<strong>Creditos Mes:</strong>$ ".number_format($sumaCreditos,0,"",".");
echo "<br>";
echo "<strong>Egresos Mes:</strong>$ ".number_format($egresosMes,0,"",".");
echo "<br>";
echo "<strong>Abonos Mes:</strong>$ ".number_format($sumaAbonos,0,"",".");
echo "<br>";
echo "<strong>Total en Caja Mes:</strong>$ ".number_format($sumaTotal+$sumaAbonos-$sumaCreditos-$egresosMes,0,"",".");
echo "<br>";
echo "<strong>Utilidad Del Mes:</strong>$ ".number_format($sumaTotal-$totalCompraMes,0,"",".");

//echo "<span style='display:block; text-align: center;'><button class='btn-flat waves-effect' onclick='imprimirreporteMensual()'>Imprimir Reporte Mensual</button></span>";	
echo	" <br> <br>   <span style='display:block; text-align: center;'><button onclick='imprimirreporteMensual()'' class='btn btn-primary'><i class='fas fa-download fa-sm text-white-50'></i> Generar Reporte Mensual</button></span>";

echo "<span style='display:block; width:100%; text-align: right;'><button class='waves-effect waves-yellow btn-flat btn' href='#' onclick='mostrarhoy()'>→ Ver historial de hoy</button></span>";
echo  "<div class='card-body'> ";
echo "  <div class='table-responsive'>";
	echo "<table  class='table'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th scope='col'>ID</th>";
	echo "<th scope='col'>FECHA</th>";
	echo "<th scope='col'>CÉDULA CLIENTE</th>";
	echo "<th scope='col'>TOTAL</th>";
	echo "<th scope='col'>ACREDITADO</th>";
	echo "<th scope='col'>DETALLES</th>";
	echo "<th scope='col'>FACTURA</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";

foreach($totalVentas as $ven){
	list($fechaventas, $horaventa) = explode(" ",$ven->fecha);
	list($aniodb, $mesdb, $diadb) = explode("-",$fechaventas);
	if ($mes == $mesdb) {
	
		echo "<tr>";
		echo "<td>".$ven->id."</td>";
		echo "<td>".$ven->fecha."</td>";
		echo "<td>".number_format($ven->cliente,0,"",".")."</td>";
		echo "<td>$ ".number_format($ven->total,0,',','.')."</td>";
		echo "<td>".number_format($ven->acreditado,0,',','.')." </td>";
		
		echo "<td>";
		echo "<a href='detalles.php?id=".$ven->id."'>Ver detalles</a>";
		echo "</td>";
	
		echo "<td class='center'>";
		echo "<button class='btn btn-danger btn-icon-split'  data-toggle='modal' data-target='#exampleModalFacturaMes".$ven->id."'> <i class='fas fa-file-invoice'></i></button>";
		echo "</td>";


		echo "</tr>";
		echo "</tbody>";

		$clientesMes=$d->buscarclientecedula($ven->cliente);
		foreach ($clientesMes as $clie){
				echo	"<div class='modal fade' id='exampleModalFacturaMes".$ven->id."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
					<div class='modal-dialog' role='document'>
					  <div class='modal-content'>
						<form action='recuperarFactura.php' method='post'>
						  <div class='modal-header'>
							<h5 class='modal-title' id='exampleModalLabel'> Factura De: $clie->nombre</h5>
							<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
							  <span aria-hidden='true'>&times;</span>
							</button>
						  </div>
		
						  <div class='modal-body'>
							<input type='hidden' name='id' value= '" .$ven->id."'>
							<input type='hidden' name='cedula' value= '" .$ven->cliente."'>
							<div class='modal-footer'>
							  <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
							  <button name='action'   id='action' type='submit' class='btn btn-primary'>Generar Factura</button>
							</div>
						  </div>
					  </div>
					  </form>
					</div>
					</div>";
				   
				  }




}}


echo "<tr>";
            echo "<td colspan='3'><strong>Total</strong></td>";
            echo "<td>$ ".number_format($sumaTotal,0,",",".")."</td>";
            echo "<td>$ ".number_format($sumaCreditos,0,",",".")."</td>";
            echo "<td colspan='1' class=''></td>";
            echo "<td colspan='1' class=''></td>";
            echo "</tr>";
echo "</table>";

echo "</div>";
echo "</div>";
	echo "</div>";


            ?>
	
	


	
			

		


            <script type="text/javascript">
	function imprimirreporte(){
		var opciones = "width=800, height=620, scrollbars=NO, top=0";
		window.open("reporte.php","nombreventa na", opciones); 
	}


function imprimirreporteMensual(){

	var opciones = "width=800, height=620, scrollbars=NO, top=0";
		window.open("reporteMensual.php","nombreventa na", opciones); 


}

</script>

<script src="js/texto.js"></script>
	<link rel="stylesheet" href="CSS2/bootstrap.min.css">
	<link rel="stylesheet" href="CSS2/bootstrap-grid.min.css"> 