<?php
session_start();

require_once "model/data.php";

$d = new Data();


$products = $d->getProductos();

include "header.php";
?>

<div class="row">
  <div class="col s12 l4"></div>
  <div class="col s12 l4"></div>
  <div class="col s12 l4"></div>

  <div class="col s12 l6"></div>

  <div class="col s12 l6"></div>
</div>

<div class="container-fluid">



  <div class="table-container">

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Agregar Al Carrito</h6>

      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" cellspacing="0">
            <thead>
              <tr>
            
                <th>MARCA</th>
               
                <th>PRECIO</th>
                <th> DISPONIBLE</th>
                <th style="width: 2em">CANTIDAD</th>
                <th style="width: 4em;">DESCUENTO</th>
                <th style="width: 12em;" class="center">ACCIONES</th>
              </tr>
            </thead>

            <tfoot>
              <tr>
            
                <th>MARCA</th>
                
                <th>PRECIO</th>
                <th> DISPONIBLE</th>
                <th style="width: 2em">CANTIDAD</th>
                <th style="width: 4em;">DESCUENTO</th>
                <th style="width: 12em;" class="center">ACCIONES</th>

              </tr>
            </tfoot>
            <tbody>
              <?php


              foreach ($products as $p) { ?>
                <tr>
                
                  <td> <?php echo $p->nombre  ?></td>
                 
                  <td>$ <?php echo number_format($p->precio_venta, 0, ',', '.') ?> </td>
                  <td> <?php echo $p->cantidad  ?></td>
                  <form action='controller/agregar.php' method='post'>
                    <td>
                      <input type='hidden' name='txt_id' value=' <?php echo $p->id ?> '>
                     
                      <input type='hidden' name='txt_nombre' value='<?php echo $p->nombre ?>'>
                   
                      <input type='hidden' name='txt_precioCompra' value=' <?php echo $p->precio_compra ?>'>
                      <input type='hidden' name='txt_precio' value=' <?php echo $p->precio_venta ?>'>
                      <input type='hidden' name='txt_stock' value=' <?php echo $p->cantidad ?>'>
                      <input type='number' name='txt_cantidad' value='1' style="width : 30px; heigth : 1px" required>
                    </td>
                    <td>
                      <input type='number' name='txt_descuento' value='0' style="width : 80px; heigth : 1px" required>
                    </td>
                    <td class='center'>
                      <button type='submit' class='btn btn-success' name='action'><i class='fas fa-cart-plus'></i> Añadir</button>
                    </td>
                  </form>
                </tr>

              <?php   }

              ?>


            </tbody>
          </table>


        </div>
      </div>
    </div>

  </div> <!-- Table container div -->
</div>


<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>


<script src="js/texto.js"></script>
<link rel="stylesheet" href="CSS2/bootstrap.min.css">
<link rel="stylesheet" href="CSS2/bootstrap-grid.min.css">