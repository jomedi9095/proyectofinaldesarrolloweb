
 
<?php



 require_once "model/data.php";
 $d= new Data();
 session_start(); 
include 'header.php';


$estado="";
?>

<?php
if (isset($_GET["m"])) {
		$m = $_GET["m"];

		switch ($m) {
			case '1':
			echo "<div class='alert alert-warning' role='alert'>
      El Producto Se Encuentra Agotado
    </div>";
			break;
			case '2':
			echo "<div class='alert alert-danger' role='alert'>
     !OJO¡ La Cantidad Ingresada No Es Correcta
    </div>";
			break;
		}
  }
  

  if (isset($_GET["action"])) {
		$action = $_GET["action"];
		if (isset($_GET["nom"])) {
			$nom = $_GET["nom"];
    }
    /* if (isset($_GET["deta"])) {
      $detalle = $_GET["deta"];
      
    }*/
    /*
    if (isset($_GET["detall"])) {
      $detalleII = $_GET["detall"];
      
    }*/
   

		if ($action=="added") {
      echo "<div class='alert alert-success' role='alert'>
      Agregado el producto $nom - al carrito.
     </div>";		} elseif ($action=="deleted") {
       echo "<div class='alert alert-danger' role='alert'>
       Producto $nom -  Eliminado del Carrito.
      </div>";
		} elseif ($action=="venta") {
			echo "<script type='text/javascript'> document.addEventListener('DOMContentLoaded', function() { M.toast({html: '¡Venta realizada!', classes: 'rounded'});; });</script>";
		} elseif ($action=="newp") {
			echo "<script type='text/javascript'> document.addEventListener('DOMContentLoaded', function() { M.toast({html: '¡$nom a sido agregado al inventario!', classes: 'rounded'});; });</script>";
		}
  }  
  

  if (isset($_GET["mensaje"])) {
    $mensaje = $_GET["mensaje"];


    if($mensaje=="falso"){

      echo "<div class='alert alert-danger' role='alert'>
      Ojo El Efectivo Ingreso Es Menor Al TOTAL De La Venta En Efectivo, Ingrese Bien El Efectivo . <br>
      Si No Existe Efectivo, Haga la Venta A Credito.
       </div> ";

    }
    
  }

?>
<center><h1><strong> CARRITO</strong></h1> <br></center>
<br>



<div class="main">
			<div class="row">

				<div class="col s12 m12 center"><!--Todo menos carrito-->

					




          <div class="container">




<?php
if (isset($_SESSION["carrito"])) {
  $carrito = $_SESSION["carrito"];

  echo "<h2>Carrito</h2>   <br>"; 
echo "
  <a href='listarCarrito.php' class='btn btn-primary btn-icon-split'>
  <span class='icon text-white-50'>
  <i class='fas fa-cart-plus'></i>
  </span>
  <span class='text'>Seguir Añadiendo</span>
</a>";

   echo  "<div class='card-body'> ";
    echo "  <div class='table-responsive'>";
  echo "<table class='table'>";
   echo "<thead>";
  echo "<tr>";
 // echo "<th scope='col'>REF</th>";
  //echo "<th scope='col'>TALLA</th>";
  echo "<th scope='col'>MARCA</th>";
  
  echo "<th scope='col'>PRECIO</th>";
  echo "<th scope='col'>STOCK</th>";
  echo "<th scope='col'>CANTIDAD</th>";
  echo "<th scope='col'>DESCUENTO</th>";
  echo "<th scope='col'>SUBTOTAL</th>";
  echo "<th scope='col'>ACCIONES</th>";
  echo "</tr>";
   echo "</thead>";

   echo "<tbody>";
  $total=0;
  $i=0;

  foreach ($carrito as $p) {
  
    echo "<tr>";
  //  echo "<td>".$p->detallesMarca."</td>";
   // echo "<td>".$p->imail."</td>";
    echo "<td>".$p->nombre."</td>";
    
    echo "<td>$ ".number_format($p->precio_venta,0,',','.')."</td>";
    echo "<td>".$p->cantidad."</td>";
    echo "<td>".$p->stock."</td>";
    echo "<td>$ ".number_format($p->descuento,0,'','.')."</td>";
    echo "<td>$ ".number_format($p->subtotal,0,',','.')."</td>";
    echo "<td>";
    echo "<a  class='btn btn-danger' href='controller/eliminarProCarrito.php?in=$i&nom=$p->nombre'>Eliminar</a>";
    echo "</td>";
    $total += $p->subtotal;
    $i++;
    echo "</tr>";
  } 
 echo " </tbody>";
  echo "<tr>";
  echo "<td colspan='6'><strong>Total</strong></td>";
  echo "<td> <strong>$ ".number_format($total,0,',','.')." </strong></td>";
  $_SESSION["total"]=$total;
  echo "<td>";
  echo "<button id='btn-abrir-popup' class='btn btn-success btn-sm btn-icon-split btn-abrir-popup' >
  <span class='text'>Vender Efectivo</span>
</button>";
  echo "&nbsp;<button  type='button' class='btn btn-info btn-sm ' data-toggle='modal' data-target='#exampleModalCredito'>
  Vender a Credito 
</button>   <br> <br> "; 
echo "  <button  type='button' class='btn btn-warning btn-sm ' data-toggle='modal' data-target='#exampleModal'>
 Cotización 
</button> ";
  echo "</td>";
  echo "</tr>";
 
  echo "</table>";
  echo "</div>";
  echo "<div>";
  echo " <strong>Cantidad de productos: </strong>".count($carrito); 
}else {

echo "<h2>El Carro Esta Vacio, Agregue Productos</h2> <br> 

<a href='listarCarrito.php' class='btn btn-success btn-icon-split'>
                    <span class='icon text-white-50'>
                    <i class='fas fa-cart-plus'></i>
                    </span>
                    <span class='text'>Click Para Listar</span>
                  </a>

";



}
?>
</div><!--container cerrar-->


				
</div>
</div>
</div>

<div class="overlay" id="overlay">
			<div class="popup" id="popup">
				<a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
				<h3>HACER VENTA</h3>
				<div class="col s12"><?php echo "Total: $ ".number_format($_SESSION["total"],0,',','.'); ?></div>
				<form action="controller/generarventa.php" method="post">
				<div class="input-field col s12 m12">
					
				</div>
					<div class="contenedor-inputs">
					<div>
       <label for="efectivoPrueba">Efectivo</label>
          <input type="number" id="efectivoPrueba" name="efectivoPrueba"  autocomplete="off" required> 
          <h5 class="modal-title" id="exampleModalLabel"> <strong>Buscar Cliente:</strong>  </h5> <br>
        <input autocomplete="off" id="cliensear" class="typeahead form-control" name="cliensear" type="search" placeholder="Buscar cliente" required>
					
					</div>
					<input type="submit" class="btn-submit " value="VENDER">
				</form>
			</div>
		</div>
  </div> 
  
  <div class="modal fade " id="exampleModalCredito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="controller/ventaCredito.php"  method="post" >
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Buscar Cliente: </h5> <br>
        <input autocomplete="off" id="cliensear" class="typeahea form-control" name="cliensear" type="search" placeholder="Buscar cliente" required>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <div class="modal-body">
      <input type="hidden" name="id" value="">
									
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button name="action"  id="action"type="submit" class="btn btn-primary">Vender</button>
      </div>
    </div>
  </div>
  </form>
</div>

</div>


  <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="controller/generarCotizacion.php"  method="post" >
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Buscar Cliente: </h5> <br>
        <input autocomplete="off" id="cliensear" class="typeahead form-control" name="cliensear" type="search" placeholder="Buscar cliente" required>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <div class="modal-body">
      <input type="hidden" name="id" value="">
									
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button name="action"  id="action"type="submit" class="btn btn-primary">Cotizar</button>
      </div>
    </div>
  </div>
  </form>
</div>
</div>
<script type="text/javascript">
			/*BUSCAR CLIENTES EN BARRA DE BUSQUEDA CON SUJERENCIAS EN VIVO*/
			$( document ).ready(function() {
				$('input.typeahead').typeahead({
					source: function (query, process) {
						return $.get('search_data.php', { query: query }, function (data) {
							data = $.parseJSON(data);
							return process(data);
						});
					},
					showHintOnFocus:'all'
				});
			}); 
      
      
      function Registrarefectivo(){
				var efectivo = $("#efectivo").val();
				$("#respuestaefe").html("Por favor espera un momento");
				$.ajax({
					type: "POST",
					dataType: 'html',
					url: "controller/cajacambio.php",
					data: "efectivo="+efectivo,
					success: function(respu){
						$('#respuestaefe').html(respu);
						Limpiar();
						Cargar();
					}
				});
			}
      


      $( document ).ready(function() {
				$('input.typeahea').typeahead({
					source: function (query, process) {
						return $.get('issetCredito.php', { query: query }, function (data) {
							data = $.parseJSON(data);
							return process(data);
						});
					},
					showHintOnFocus:'all'
				});
			}); 
      
      
       </script>
<script src="popup.js"></script>
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600|Open+Sans" rel="stylesheet"> 
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	<link rel="stylesheet" href="estilos.css">

  <script src="js/typeahead.js"></script>



  <script src="js/texto.js"></script>
<link rel="stylesheet" href="CSS2/bootstrap.min.css">
<link rel="stylesheet" href="CSS2/bootstrap-grid.min.css">



  