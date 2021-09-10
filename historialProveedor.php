<?php

session_start();
require_once "model/data.php";

$d =  new Data();

$proveedorTodos= $d->getProveedor();
$sumaTodos=0;
$sumaFlete=0;
$total=0;
foreach ($proveedorTodos as $p){
$sumaTodos += $p->valorFactura;
$sumaFlete += $p->flete;


}
$total= $sumaTodos + $sumaFlete;

include "header.php"
?>





<div class="row">
    <div class="col s12 l4"></div>
    <div class="col s12 l4"></div>
    <div class="col s12 l4"></div>

    <div class="col s12 l6"></div>

    <div class="col s12 l6"></div>
  </div>

  <div class="container-fluid">

  <strong> Total Compras: $</strong> <?php echo number_format($sumaTodos,0,'','.') ?> <br>
 <strong> Total Flete: $</strong> <?php echo number_format($sumaFlete,0,'','.') ?> <br> 
 <strong> Total : $</strong> <?php echo number_format($total,0,'','.') ?>
<br>

<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Historial Completo De Compras</h6>
     
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable"  cellspacing="0">
  <thead class="thead-dark">
    <tr>
    <th >DESCRIPCION</th>
      <th >FECHA</th>
      <th >VALOR FACTURA</th>
      <th >FLETE</th>
      <th >PROVEEDOR</th>
      <th >MEDIO DE PAGO</th>
    </tr>
  </thead>
  <tfoot>
            <tr>
            
            <th >DESCRIPCION</th>
      <th >FECHA</th>
      <th >VALOR FACTURA</th>
      <th >FLETE</th>
      <th >PROVEEDOR</th>
      <th >MEDIO DE PAGO</th>
            </tr>
          </tfoot>

  <tbody>
<?php

foreach ($proveedorTodos as $pro){
   echo " <tr>";
   echo   "<th scope='row'>".$pro->descripcion."</th>";
   echo   "<th scope='row'>".$pro->fecha."</th>";
    echo  "<td scope='row'>".number_format($pro->valorFactura,0,'','.')."</td>";
     echo "<td>".number_format($pro->flete,0,'','.')."</td>";
    echo  "<td>".$pro->proveedor."</td>";
    echo  "<td>".$pro->medioPago."</td>";
   
  echo  "</tr>";
  


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