<?php 
session_start();

require_once "model/data.php";

$d=  new Data();
$totalVentas=$d->totalVentas();
$sumaAbonos=0;
$sumaVentas=0;
$creditos=0;
$sumaCreditos=0;
foreach ($totalVentas as $ven){
$sumaVentas += $ven->total;
$sumaCreditos += $ven->acreditado;
}


$abonos=$d->getAbonado();
foreach($abonos as $abo){
$sumaAbonos += $abo->abono;

}
$creditos=$sumaCreditos-$sumaAbonos;
$egresos = $d->getEgresos();

include 'header.php';
?>



<div class="row">
    <div class="col s12 l4"></div>
    <div class="col s12 l4"></div>
    <div class="col s12 l4"></div>

    <div class="col s12 l6"></div>

    <div class="col s12 l6"></div>
  </div>

  <div class="container-fluid">

  <strong> Total Ventas: $</strong> <?php echo number_format($sumaVentas,0,'','.') ?> <br>
 <strong> Creditos Vigentes: $</strong> <?php echo number_format($creditos,0,'','.') ?> <br> 
<br>

<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Historial Completo De Ventas</h6>
     
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable"  cellspacing="0">
  <thead class="thead-dark">
    <tr>
    <th >FECHA</th>
      <th >C.C CLIENTE</th>
      <th >TOTAL</th>
      <th >ACREDITADO</th>
      <th >DETALLES</th>
      <th >FACTURA</th>
    </tr>
  </thead>
  <tfoot>
            <tr>
            
            <th >FECHA</th>
      <th >C.C CLIENTE</th>
      <th >TOTAL</th>
      <th >ACREDITADO</th>
      <th >DETALLES</th>
      <th >FACTURA</th>
            </tr>
          </tfoot>

  <tbody>
<?php

foreach ($totalVentas as $ve){
   echo " <tr>";
   echo   "<th scope='row'>".$ve->fecha."</th>";
    echo  "<td scope='row'>".$ve->cliente."</td>";
     echo "<td>".number_format($ve->total,0,'','.')."</td>";
    echo  "<td>".number_format($ve->acreditado,0,'','.')."</td>";

    echo "<td>";
		echo "<a href='detalles.php?id=".$ve->id."'>Ver detalles</a>";
    echo "</td>";
    
    echo "<td class='center'>";
		echo "<button class='btn btn-danger btn-icon-split'  data-toggle='modal' data-target='#exampleModalFacturaTodos".$ve->id."'> <i class='fas fa-file-invoice'></i></button>";
		echo "</td>";
  echo  "</tr>";
    
  $clientes=$d->buscarclientecedula($ve->cliente);

	foreach ($clientes as $clie){
    echo	"<div class='modal fade' id='exampleModalFacturaTodos".$ve->id."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
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
       
      }


}
  ?>


</tbody>
</table>
</div>
    </div>
  </div>
</div>



<script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>


<script src="js/texto.js"></script>
	<link rel="stylesheet" href="CSS2/bootstrap.min.css">
	<link rel="stylesheet" href="CSS2/bootstrap-grid.min.css"> 