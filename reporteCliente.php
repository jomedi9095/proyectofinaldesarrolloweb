<?php
date_default_timezone_set('America/Bogota');
session_start();
require_once "model/data.php";

$d =  new Data();
$cedula = $_POST["cedula"];
$acreditado=0;
$totalAcreditado = $d->ventasCreditos($cedula);
foreach ($totalAcreditado as $cre){
$acreditado += $cre->acreditado;

}
$totalVentas = $d->ventasClientes($cedula);
$cliente = $d->buscarclientecedula($cedula);

$deuda = $d->buscarcreditocedula($cedula);

foreach ($deuda as $de) {
}
foreach ($cliente as $cli) {
}

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
$total = 0;


?>








<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />

<style type="text/css">
  * {
    margin: 0;
    padding: 0;
  }

  .todo {
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
  <h2 class="center">Reporte De Ventas</h2>
  <h4 class="center"><?php echo date("Y-m-d"); ?></h4>

  <div class="container">
    <div>
    <h2 class="center">Cliente</h2>
      <br>
      <strong>Nombre :</strong> <?php echo $cli->nombre ?>
      <br>
      <strong>Cedula: </strong>   <?php echo number_format($cli->cedula,0,",",".") ?>
      <br>
      <strong>Deuda: </strong> <?php if(isset($de->gastado)){  echo number_format($de->gastado,0,",",".");}  else {echo "No Tiene Credito";}?>


      <table class='table'>
        <thead>
          <tr>
            <th>ID</th>
            <th>FECHA</th>
          <!--  <th>TALLA</th> -->
            <th>MARCA</th>
           
            <th>SUBTOTAL</th>
            

            </tr>
          </thead>
         <?php  $i=0; ?>
        <tbody>
          <?php    
          
          foreach ($totalVentas as $ve) { 
           
           $total+=$ve->subTotal; ?>
          <tr>
            <td> <?php echo $ve->id  ?></td>
            <td> <?php echo $ve->fecha ?></td>
          <!--  <td><?php //echo $ve->imail ?></td> -->
            <td><?php echo $ve->producto ?></td>
           <!-- <td><?php //echo $ve->detallesMarca ?></td> -->
            <td>$ <?php echo  number_format($ve->subTotal,0,',','.') ?></td>
           



            </tr>
          </tbody>

        <?php }  ?>
        <tr>
          <td colspan='3'> <strong>TOTAL VENTAS A CREDITOS </strong></td>

          <td>$ <?php echo number_format($acreditado,0,",",".") ?></td>

          </tr>
        <tr>
          <td colspan='3'> <strong>TOTAL </strong></td>

          <td>$ <?php echo number_format($total,0,",",".") ?></td>

          </tr>


        </table>

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