<?php  
session_start();
require_once 'model/data.php';
$d= new Data();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
if (isset($_GET["cedula"])) {
    $cedula=$_GET["cedula"];
  }
 
  $credito = $d->buscarcreditocedula($cedula);
  $creditos = $d->getCreditos($cedula);
  foreach ($credito as $cre) {
   $cre->monto;
   $cre->gastado;
   $cre->fecha_credito;
 }
 
 foreach ($creditos as $cr) {
   $cr->monto;
   $cr->gastado;
   $cr->fecha_credito;
 }
 
 $clientes = $d->buscarclientecedula($cedula);
 foreach ($clientes as $cli) {
  $cli->id;
  $cli->nombre;
  $cli->cedula;
  $cli->celular;
  $cli->direccion;
  $cli->credito;
  $cli->saldo_pendiente;
  $cli->fecha_credito;
  $cli->fecha_saldo;
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

$pagename="Actualizar cliente";
include 'header.php';
?>
<div class="container-fluid">
 <div class="d-sm-flex align-items-center justify-content-between mb-4">

</div>

<div class="row" style="margin-top: 10px;">
	<div class="col s12 m4 center">
	<div class="col s12">
  
  <h2> <strong> Informacion del Cliente</strong></h2></div> 
		<img src="images/perfil1.png" class="circle foto_perfil" alt="Foto perfil" width="40%">
  </div>	
	<div class="col m8">
    <br>

  <button href="#" class="btn btn-primary btn-icon-split"  data-toggle='modal' data-target='#exampleModalBorrar'><i class="fas fa-download fa-sm text-white-50"></i> Reporte De Ventas</button>
<br>
<br>
  <button href="#" class="btn btn-warning btn-icon-split"  data-toggle='modal' data-target='#exampleModalAbono'><i class="fas fa-download fa-sm text-white-50"></i> Reporte De Abonos</button>
  <br>
<br>
   <h4><?php echo "<strong>$cli->nombre</strong> 
    <button type='submit'  id='btn-abrir-popup' class='btn btn-success btn-icon-split btn-abrir-popup'><i class='far fa-edit '></i></button>";?>
  </h4>
			<div class="col s12"><?php echo "<strong>Nombre:</strong> ".$cli->cedula; ?></div>
			<div class="col s12"><?php echo "<strong>Dirección:</strong> ".$cli->direccion; ?></div> 
			<div class="col s12"><?php echo "<strong>Celular:</strong> ".$cli->celular; ?></div> 
			
		
	</div>
</div>




<div class="divider"></div>





    
<div class="row">
  <div class="col m4 push-m8 s12">
    <h4> <strong> Credito Del Ciente</strong> </h4>
    <div class="card-body">
      <div class="table-responsive">
    <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Vida Crediticia</th>
      <th scope="col">Deuda Actual</th>
      <th scope="col">Fecha Del Credito</th>
    </tr>
  </thead>
  <tbody>
    
  <?php
  $abonos = $d->getAbonos($cedula);
      foreach ($creditos as $cr) {
        $abonos_total=0; $creditoinicial=0;
        foreach ($abonos as $ab) {
          if ($ab->id_credito==$cr->id) {
            $abonos_total += $ab->abono;
          }
        }
        $creditoinicial = $cr->monto + $cr->gastado + $abonos_total;
        echo "<tr>";
        echo "<td>".$cr->id."</td>";
        echo "<td>$ ".number_format($creditoinicial,0,',','.')."</td>";
        echo "<td>$ ".number_format($cr->gastado,0,',','.')."</td>";
        echo "<td>".$cr->fecha_credito."</td>";
        echo "</tr>";
      }
      if ($creditos == null) {
        echo "<tr><td colspan='5' class='center'>¡No se han realizado ningun credito!</td></tr>";
      }
      ?>
  </tbody>
</table>
  </div>
  </div>
  </div>


  <div class="col m7 pull-m4 s12">
    <h4 > <strong>Abonos de creditos</strong> </h4>
    <div class="card-body">
      <div class="table-responsive">
    <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID Credito</th>
      <th scope="col">Abono </th>
      <th scope="col"> Cajero Responsable</th>
      <th scope="col">Fecha</th>
    </tr>
  </thead>
  <tbody>
  <?php
      $abonos = $d->getAbonos($cedula);
      $totalabonos = 0;
      foreach ($abonos as $ab) {
        echo "<tr>";
        echo "<td class='center'>".$ab->id_credito."</td>";
        echo "<td>$ " .number_format($ab->abono,0,",",".")."</td>";
        echo "<td>".$ab->atendido."</td>";
        echo "<td>".$ab->fecha_abono."</td>";
        
        echo "</tr>";
        $totalabonos += $ab->abono;

      }
      if ($abonos == null) {
        echo "<tr><td colspan='5' class='center'>¡No se han realizado abonos!</td></tr>";
      }
      ?>
  </tbody>
</table>
  </div>
</div>
</div>
</div>


</div>
<?php
}

else{
    header("Location:login.php");; 


}
include "footer.php";

?>

<div class="modal fade " id="exampleModalBorrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <form action="reporteCliente.php" method="post">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Reporte De: <?php echo $cli->nombre; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <input type="hidden" name="cedula" value="<?php echo $cli->cedula; ?>">

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button name="action"   id="action" type="submit" class="btn btn-primary">Generar Reporte</button>
                    </div>
                  </div>
              </div>
              </form>
            </div>
            </div>

            <div class="modal fade " id="exampleModalAbono" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <form action="reporteAbono.php" method="post">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Reporte De: <?php echo $cli->nombre; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <input type="hidden" name="cedula" value="<?php echo $cli->cedula; ?>">

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button name="action"   id="action" type="submit" class="btn btn-primary">Generar Reporte</button>
                    </div>
                  </div>
              </div>
              </form>
            </div>
            </div>






<div class="overlay" id="overlay">
			<div class="popup" id="popup">
				<a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
				<h3>EDITAR CLIENTE</h3>
				
				<form action="controller/modificarCliente.php" method="post">
				<div class="input-field col s12 m12">
					
				</div>
					<div class="contenedor-inputs">
					<input name="id" type="hidden" value="<?php  echo $cli->id; ?>">
					<label for="nombre">Nombre</label>
					<input id="nombre" name="nombre" type="text" class="validate" value="<?php  echo $cli->nombre; ?>" required>
					<label for="cedula">Cedula</label>
					<input id="cedula" name="cedula" type="text" class="validate" value="<?php echo $cli->cedula; ?>" required>
					
					<label for="direccion">Dirección</label>
					<input id="direccion" name="direccion" type="text" class="validate" value="<?php echo $cli->direccion; ?>" required>
					
					<label for="celular">celular</label>
					<input id="celular" name="celular" type="text" class="validate" value="<?php echo $cli->celular; ?>" required>
					
				
					</div>
					<input type="submit" class="btn-submit " value="ACTUALIZAR">
				</form>
			</div>
		</div>
	</div>


  <script type="text/javascript">
	function imprimirreporte(){
		var opciones = "width=800, height=620, scrollbars=NO, top=0";
		window.open("reporteCliente.php","nombreventa na", opciones); 
	}







</script>


<script src="popup.js"></script>



<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600|Open+Sans" rel="stylesheet"> 
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
<link rel="stylesheet" href="estilos.css">

<script src="https://kit.fontawesome.com/18e932af55.js"></script>
	<link rel="stylesheet" href="CSS2/bootstrap.min.css">
  <link rel="stylesheet" href="CSS2/bootstrap-grid.min.css"> 
  
  
