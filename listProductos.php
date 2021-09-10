<?php
session_start();

require_once "model/data.php";
$d = new Data();

$productos = $d->getProductos();

$rescate= $d->getProductosRescate();
$total = 0;


foreach ($rescate as $re){



}
$totalSub=0;
foreach ($productos as $prod) {
  $subtotal = 0;
  $precioCompra = 0;
  $utilidad = 0;

  $subtotal = $prod->precio_venta * $prod->cantidad;
  $precioCompra = $prod->precio_compra * $prod->cantidad;
  $utilidad = $subtotal - $precioCompra;
  $total += $utilidad;
  $totalSub += $subtotal;


}



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
  <div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">UTILIDAD TOTAL</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($total, 0, '', '.')   ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">TOTAL INVENTARIO</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($totalSub, 0, '', '.')   ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
 
  <!-- Busqueda-->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Marcancia Registrada</h6>
      <span style='display:block; width:50%; text-align: right;'><button id="btn-abrir-popup" class="btn btn-danger btn-icon-split btn-abrir-popup">
            <span class="icon text-white-30">
            <i class="fas fa-tshirt"></i>   

            </span> 
            <span class="text">Agregar Producto</span>
          </button></span>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable"  cellspacing="0">
          <thead>
            <tr>
              <th>Marca</th>
              
              <th>Cantidad</th>
              <th>Precio De Compra</th>
              <th>Precio De Venta</th>
              <th>Subtotal</th>
              <th>Utilidad</th>
              <th>Acciones</th>

            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Marca</th>
             
              <th>Cantidad</th>
              <th>Precio De Compra</th>
              <th>Precio De Venta</th>
              <th>Subtotal</th>
              <th>Utilidad</th>
              <th>Acciones</th>

            </tr>
          </tfoot>

          <tbody>
            <?php
            $contador = 1;
            foreach ($productos as $pro) {
              $subtotal = 0;
              $precioCompra = 0;
              $utilidad = 0;

              $subtotal = $pro->precio_venta * $pro->cantidad;
              $precioCompra = $pro->precio_compra * $pro->cantidad;
              $utilidad = $subtotal - $precioCompra;
            ?>
              <tr>
              
                <td> <?php echo $pro->nombre;   ?></td>
                
                <td> <?php echo $pro->cantidad;   ?></td>
                <td><?php echo number_format($pro->precio_compra, 0, '', '.');   ?> </td>
                <td><?php echo  number_format($pro->precio_venta, 0, '', '.'); ?></td>
                <td><?php echo  number_format($subtotal, 0, '', '.'); ?></td>
                <td><?php echo  number_format($utilidad, 0, '', '.'); ?></td>

                <td>
                  <a class='btn btn-primary btn-circle  btn-sm' href='editarPro.php?id=<?php echo $pro->id ?>'><i class='far fa-edit'></i>
                  </a>

                  <br>
                  <br>


                  <button class='btn btn-warning btn-circle  btn-sm' type='submit' data-toggle='modal' data-target='#exampleModalBorrar<?php echo $pro->id ?>'><i class='fas fa-trash'></i>
                  </button>
                  </td>
              </tr>

              <div class="modal fade " id="exampleModalBorrar<?php echo $pro->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <form action="controller/eliminarProducto.php" method="post">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Borrar El Prodcuto: <?php echo $pro->nombre; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <input type="hidden" name="id" value="<?php echo $pro->id; ?>">

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button name="action" id="action" type="submit" class="btn btn-primary">Borrar</button>
                    </div>
                  </div>
              </div>
              </form>
            </div>

          <?php } ?>
           
          </tbody>
 <!-- MODAL BORRAR-->
 
        </table>
      </div>
    </div>
  </div>

</div>




<div class="overlay" id="overlay">
  <div class="popup" id="popup">
    <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
    <h1>AGREGAR PRODUCTO</h1>

    <form action="controller/agregarProducto.php" method="post">
      <div class="input-field col s12 m12">

      </div>
      <div class="contenedor-inputs">
        <div>
      
          <label for="nombre">MARCA</label>
          <input id="nombre" name="nombre" type="varchar" class="validate" value="<?php if(isset($re->nombre)){ echo $re->nombre; } else {echo "";} ?>"  placeholder="Añade Marca"  required>
         
        </div>
        <label for="cantidad">CANTIDAD</label>
        <input id="cantidad" name="cantidad" type="number" class="validate"  required>


        <label for="precio_compra">Precio De Compra</label>
        <input id="precio_compra" name="precio_compra" type="number" class="validate" value="<?php echo $re->precio_compra  ?>" required>

        <label for="precio_venta">Precio De Venta</label>
        <input id="precio_venta" name="precio_venta" type="number" class="validate" value="<?php echo $re->precio_venta  ?>" required>
      </div>
      <input type="submit" class="btn-submit " value="AGREGAR">
    </form>
  </div>
</div>
</div>



<?php
include 'footer.php';
?>
<!--
<script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->

  <!-- Core plugin JavaScript
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script> -->

  <!-- Custom scripts for all pages
  <script src="js/sb-admin-2.min.js"></script> -->

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>


<script src="popup.js"></script>



<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600|Open+Sans" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
<link rel="stylesheet" href="estilos.css">

<script src="js/texto.js"></script>
<link rel="stylesheet" href="CSS2/bootstrap.min.css">
<link rel="stylesheet" href="CSS2/bootstrap-grid.min.css">


