<?php   
date_default_timezone_set('America/Bogota');
session_start();
require_once "model/data.php";

$d =  new Data();

$proveedorTodos= $d->getProveedor();
$proveedorHoy= $d->getProveedorHoy();

$sumaHoy=0;
$sumaFlete=0;
$totalHoy=0;
foreach ($proveedorHoy as $pl) {
$sumaFlete += $pl->flete;
$sumaHoy += $pl->valorFactura;
}

$totalHoy= $sumaHoy + $sumaFlete;
$now=date("Y-m-d");
	list($año, $mes, $dia) = explode('-', $now);





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
<center><a  class='btn btn-success   ' type='submit' href='historialProveedor.php' ><i class="fas fa-clipboard"></i> Historial De Compras </a></center>
		<?php 
		echo "<div id='hoy'>";
		echo "<h1>Proveedores Hoy</h1>";
        echo "<strong>Fecha:</strong> ".$now;
        echo "<br>";
        echo "<strong>Monto Compras:</strong> ".number_format($sumaHoy,0,"",".");
        echo "<br>";
        echo "<strong>Monto Fletes:</strong> ".number_format($sumaFlete,0,"",".");
		echo "<br>";
        echo "<strong>Total Hoy :</strong> ".number_format($totalHoy,0,"",".");
	
        echo	"  <br> <br> <span style='display:block; text-align: center;'><button id='btn-abrir-popup' class='btn btn-danger btn-icon-split btn-abrir-popup'><i class='fas fa-shopping-cart fa-sm text-white-50'></i> Registrar Compra</button></span>";
        echo	"  <br> <br> <span style='display:block; text-align: center;'><button onclick='imprimirreporte()' class='btn btn-primary'><i class='fas fa-download fa-sm text-white-50'></i> Generar Reporte Diario</button></span>";
		echo "<span style='display:block; width:100%; text-align: right;'><button class='acceuno waves-effect waves-yellow btn-flat btn' href='#' onclick='mostrarcon()'>→ Ver Historial Del Mes</button></span>";
	  
		echo  "<div class='card-body'> ";
echo "  <div class='table-responsive'>";
		
		echo "<table  class='table'>";
        echo "<thead>";
		echo "<tr>";
		echo "<th scope='col'>DESCRPCION</th>";
		echo "<th scope='col'>FECHA</th>";
		echo "<th scope='col'>VALOR FACTURA</th>";
		echo "<th scope='col'>FLETE</th>";
		echo "<th scope='col'>PROVEEDOR</th>";
		echo "<th scope='col'>MEDIO DE PAGO</th>";
		echo "<th scope='col'>ACCIONES</th>";
	
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
			echo "<td> ".$p->proveedor."</td>";
            echo "<td> ".$p->medioPago."</td>";

			echo "<td>";
			
			echo "	<button class='btn btn-warning btn-circle  btn-sm' type='submit' data-toggle='modal' data-target='#exampleModalBorrar$p->id'><i class='fas fa-trash'></i>
				</button>
				</td>";
			echo "</tr>";
			

			
		echo"	<div class='modal fade ' id='exampleModalBorrar$p->id' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
              <div class='modal-content'>
                <form action='controller/eliminarProveedor.php' method='post'>
                  <div class='modal-header'>
                    <h5 class='modal-title' id='exampleModalLabel'> Borrar El Producto: $p->descripcion</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button>
                  </div>

                  <div class='modal-body'>
                    <input type='hidden' name='id' value='$p->id'>

                    <div class='modal-footer'>
                      <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                      <button name='action' id='action' type='submit' class='btn btn-primary'>Borrar</button>
                    </div>
                  </div>
              </div>
              </form>
            </div>";
			echo "</tbody>";
			
  } 
 
            echo "<tr>";
            echo "<td colspan='3'><strong>TOTAL</strong></td>";
            echo "<td>$ ".number_format($totalHoy,0,",",".")."</td>";
       
            echo "<td colspan='1' class=''></td>";
            echo "<td colspan='1' class=''></td>";
            echo "</tr>";


		echo "</table>";
		echo "</div>";
		echo "</div>";

echo "</div>";



$sumaMes=0;
$sumaFleteMes=0;
$sumaTotalMes=0;
foreach($proveedorTodos as $pt){
	list($fechaventas, $horaventa) = explode(" ",$pt->fecha);
	list($aniodb, $mesdb, $diadb) = explode("-",$fechaventas);
	if ($mes == $mesdb) {
		$sumaMes += $pt->valorFactura;
		$sumaFleteMes += $pt->flete;}}

$sumaTotalMes= $sumaMes+$sumaFleteMes;

     echo "<div id='siempre' style='display:none;'>";
	echo "<h1>Ventas Del Mes</h1>";
echo "<strong>Compra Mes:</strong>$ ".number_format($sumaMes,0,"",".");
echo "<br>";
echo "<strong>Flete Mes:</strong>$ ".number_format($sumaFleteMes,0,"",".");
echo "<br>";
echo "<strong>Total Mes:</strong>$ ".number_format($sumaTotalMes,0,"",".");

//echo "<span style='display:block; text-align: center;'><button class='btn-flat waves-effect' onclick='imprimirreporteMensual()'>Imprimir Reporte Mensual</button></span>";	
echo	" <br> <br>   <span style='display:block; text-align: center;'><button onclick='imprimirreporteMensual()'' class='btn btn-primary'><i class='fas fa-download fa-sm text-white-50'></i> Generar Reporte Mensual</button></span>";

echo "<span style='display:block; width:100%; text-align: right;'><button class='waves-effect waves-yellow btn-flat btn' href='#' onclick='mostrarhoy()'>→ Ver historial de hoy</button></span>";
echo  "<div class='card-body'> ";
echo "  <div class='table-responsive'>";
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
		

		echo "<td>";
			
		echo "	<button class='btn btn-warning btn-circle  btn-sm' type='submit' data-toggle='modal' data-target='#exampleModalBorrarMes$pro->id'><i class='fas fa-trash'></i>
			</button>
			</td>";
		echo "</tr>";
		

		
	echo"	<div class='modal fade ' id='exampleModalBorrarMes$pro->id' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
		<div class='modal-dialog' role='document'>
		  <div class='modal-content'>
			<form action='controller/eliminarProveedor.php' method='post'>
			  <div class='modal-header'>
				<h5 class='modal-title' id='exampleModalLabel'> Borrar El Prodcuto: $pro->descripcion</h5>
				<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
				  <span aria-hidden='true'>&times;</span>
				</button>
			  </div>

			  <div class='modal-body'>
				<input type='hidden' name='id' value='$pro->id'>

				<div class='modal-footer'>
				  <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
				  <button name='action' id='action' type='submit' class='btn btn-primary'>Borrar</button>
				</div>
			  </div>
		  </div>
		  </form>
		</div>";
		echo "</tbody>";

		




}}


echo "<tr>";
            echo "<td colspan='3'><strong>TOTAL</strong></td>";
            echo "<td>$ ".number_format($sumaTotalMes,0,",",".")."</td>";
         
            echo "<td colspan='1' class=''></td>";
            echo "<td colspan='1' class=''></td>";
            echo "</tr>";
echo "</table>";

echo "</div>";
echo "</div>";
	echo "</div>";


            ?>
	
	


	
			


    <div class="overlay" id="overlay">
  <div class="popup" id="popup">
    <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
    <h1>AGREGAR COMPRA</h1>

    <form action="controller/agregarProveedor.php" method="post">
      <div class="input-field col s12 m12">

      </div>
      <div class="contenedor-inputs">
        <div>
        <label for="descripcion">DESCRIPCION</label>
          <input id="descripcion" name="descripcion" type="varchar" class="validate"   placeholder="Añade Descripcion"  required>
          <label for="valorFactura"> VALOR FACTURA</label>
          <input id="valorFactura" name="valorFactura" type="number" placeholder="Añade Monto" class="validate" required>
          <label for="flete">FLETE</label>
          <input id="flete" name="flete" type="number" class="validate"   value="0"  required>
         
        </div>
        <label for="proveedor">PROVEEDOR</label>
        <input id="proveedor" name="proveedor" type="varchar" class="validate"  required>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Seleccione Metodo De Pago</label>
               <select class="form-control" id="exampleFormControlSelect1" name="medioPago">
                        <option>Efectivo</option>
                        <option>Transferencia</option>
                        
               </select>
        </div>
      
      </div>
      <input type="submit" class="btn-submit " value="AGREGAR">
    </form>
  </div>
</div>
</div>


		


            <script type="text/javascript">
	function imprimirreporte(){
		var opciones = "width=800, height=620, scrollbars=NO, top=0";
		window.open("reporteCompraDia.php","nombreventa na", opciones); 
	}


function imprimirreporteMensual(){

	var opciones = "width=800, height=620, scrollbars=NO, top=0";
		window.open("reporteCompraMes.php","nombreventa na", opciones); 


}

</script>
<script src="popup.js"></script>
<link rel="stylesheet" href="estilos.css">
<script src="js/texto.js"></script>
	<link rel="stylesheet" href="CSS2/bootstrap.min.css">
	<link rel="stylesheet" href="CSS2/bootstrap-grid.min.css"> 