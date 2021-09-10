<?php
session_start();
require_once "model/data.php";
$d = new Data();

$clientes = $d->getClientes();

?>
<?php
$pagename = "Lista Clientes";

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
  <!-- Busqueda-->



  <!-- Busqueda-->


  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Clientes Registrados</h6>
      <span style='display:block; width:50%; text-align: right;'><button id="btn-abrir-popup" class="btn btn-success btn-icon-split btn-abrir-popup">
          <span class="icon text-white-30">
            <i class="fas fa-male"></i>

          </span>
          <span class="text">Agregar Cliente</span>
        </button></span>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Cedula</th>
              <th>Nombre completo</th>
              <th>Correo</th>
              <th>Celular</th>
              <th>Direccion</th>
              <th>Credito Actual</th>
              <th>Credito Gastado</th>
              <th>Hacer Creditos</th>
              <th>Hacer Pagos</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>#</th>
              <th>Cedula</th>
              <th>Nombre completo</th>
              <th>Correo</th>
              <th>Celular</th>
              <th>Direccion</th>
              <th>Credito Actual</th>
              <th>Credito Gastado</th>
              <th>Hacer Creditos</th>
              <th>Hacer Pagos</th>
              <th>Acciones</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            $creditostodos = $d->getTodosCreditos();
            $contador = 0;
            foreach ($clientes as $cli) {
              $contador++;
              $monto = "No";
              $gastado = 0;
              $credito = $d->buscarcreditocedula($cli->cedula);
              foreach ($credito as $cre) {
               
                $cre->gastado;
              }

              foreach ($creditostodos as $creditos) {
                if ($creditos->cliente == $cli->cedula) {
                  $classdisabledcredito = "disabled";
                  $monto = "Si";
                  $gastado = $creditos->gastado;
                }

                else {
                  $classdisabledcredito = "enabled";
                  
                }
              }

              if (isset($gastado) && $gastado > 0) {
                $classdisabled = "disabled";
                $classdisabledpago = "enabled";
              } else {
                $classdisabled = "enabled";
                $classdisabledpago = "disabled";
              }
           
            
              if (!isset($creditos->gastado)) {
                $gastado = 0;
              }
            

            ?>


              <tr>
                <td > <?php echo $contador   ?></td>
                <td > <?php echo number_format($cli->cedula, 0, '', '.')   ?></td>
                <td > <?php echo  $cli->nombre  ?></td>
                <td> <?php echo  $cli->correo  ?></td>
                <td > <?php echo $cli->celular   ?></td>

                <td> <?php echo $cli->direccion  ?></td>
                <td>
                <?php echo $monto?>
                </td>
                <td>
                  $ <?php echo number_format($gastado, 0, '', '.') ?>
                </td>
                <?php
                echo "<td class='center'>
                  <a type='button' class='btn btn-primary " . $classdisabled . " " . $classdisabledcredito . " ' data-toggle='modal' data-target='#exampleModal$cli->id'><i class='fas fa-credit-card'></i>
                   Habilitar
                  </a>
                </td> "; ?>
                <?php
                echo   "<td class='center'>
                  <a type='button' class='btn btn-warning " . $classdisabledpago . "' data-toggle='modal' data-target='#exampleModalPago$cli->id'><i class='fas fa-credit-card'></i>
                    Bonficar
                  </a>
                </td> "; ?>
                <td class='center'>
                  <a class='btn btn-primary btn-circle btn-sm ' href='actcliente.php?cedula=<?php echo $cli->cedula ?>'><i class='far fa-edit'></i>
                  </a>


                  <br>

                  <br>
                  <button class="btn btn-danger btn-circle btn-sm" type='submit' data-toggle='modal' data-target='#exampleModalBorrar<?php echo $cli->id ?>'><i class='fas fa-trash'></i>
                  </button>
                </td>


              </tr>





   <!-- Button trigger modal -->

          <!-- Modal -->
          <div class="modal fade " id="exampleModal<?php echo $cli->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <form action="controller/asignar_credito.php" method="post">
                  <div class="modal-header">
                    <h2>Desea Habilitar El Credito A</h2> <br>
                    <h5 class="modal-title" id="exampleModalLabel">Cliente: <?php echo $cli->nombre; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <input type="hidden" name="id" value="<?php echo $cli->id; ?>">
                    <input type="hidden" name="cliente" value="<?php echo $cli->cedula; ?>">
                    <input type="hidden" name="cajero" value="<?php echo $_SESSION['nombre']; ?>">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button name="action" id="action" type="submit" class="btn btn-primary">Habilitar Credito</button>
                  </div>
              </div>
            </div>
            </form>
          </div>



          <!-- MODAL PAGO -->
          <div class="modal fade " id="exampleModalPago<?php echo $cli->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <form action="controller/abono.php" method="post">
                  <div class="modal-header">
                    <h1><strong>Realizar Abono </strong> </h1>
                    <h5 class="modal-title" id="exampleModalLabel"> <strong> Cliente:</strong> <?php echo $cli->nombre; ?> <br>
                      <strong> Saldo actual:</strong> <br> <?php echo "$ " . number_format($cre->gastado, 0, ",", "."); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <input type="hidden" name="cedula" value="<?php echo $cli->cedula; ?>">
                    <input id="abono<?php echo $cli->id; ?>" name="abono" type="number" max="<?php echo $gastado; ?>" class="validate" autocomplete="off" minlength="8" required>
                    <label for="abono<?php echo $cli->id; ?>">Inserte el Abono</label>
                    <input type="hidden" name="atendido" value="<?php echo $_SESSION['nombre']; ?>">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button name="action" id="action" type="submit" class="btn btn-primary">Abonar </button>
                  </div>
              </div>
            </div>
            </form>
          </div>

          <!--  MODAL BORRAR -->

          <div class="modal fade " id="exampleModalBorrar<?php echo $cli->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <form action="controller/eliminarCliente.php" method="post">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Borrar A: <?php echo $cli->nombre; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <input type="hidden" name="id" value="<?php echo $cli->id; ?>">

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button name="action" id="action" type="submit" class="btn btn-primary">Borrar</button>
                    </div>
                  </div>
              </div>
              </form>
            </div>

          <?php
            }
          ?>




          </tbody>


       
        </table>
      </div>
    </div>

  </div>
</div>






<div class="overlay" id="overlay">
  <div class="popup" id="popup">
    <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
    <h3>AGREGAR CLIENTE</h3>

    <form action="controller/nuevo_cliente.php" method="post">
      <div class="input-field col s12 m12">

      </div>
      <div class="contenedor-inputs">
        <div>
          <label for="nombre">Nombres y Apellidos</label>
          <input id="nombre" name="nombre" type="text" class="validate" minlength="6" required>

        </div>
        <label for="cedula">Cedula</label>
        <input id="cedula" name="cedula" type="number" class="validate" minlength="6" required>

        <label for="correo">Correo Electronico</label>
        <input id="correo" name="correo" type="email" class="validate" required>

        <label for="direccion">Dirección</label>
        <input id="direccion" name="direccion" type="text" class="validate" minlength="5" required>

        <label for="celular">Celular</label>
        <input id="celular" name="celular" type="text" class="validate" minlength="5" required>



      </div>
      <input type="submit" class="btn-submit " value="AGREGAR">
    </form>
  </div>
</div>
</div>






<?php
include 'footer.php';
?>
<script>
  var options = {
    valueNames: ['name']
  };

  var userList = new List('users', options);
</script>


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
<!--<link rel="stylesheet" href="CSS2/estilos.css">-->