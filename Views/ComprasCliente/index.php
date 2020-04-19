
<?php

session_start();

if(!isset($_SESSION["nombre"])){
   header("Location: http://localhost/WampCode/Yurani_Duque");
}

include "../../Config/Conexion.php";

$conexion = new Conexion();
$query = "SELECT * FROM clientes WHERE id = '" . $_GET["id"] . "'";
$statement = $conexion->pdo->query($query);
$conexion->cerrarConexion();
$cliente = $statement->fetchAll(PDO::FETCH_OBJ)[0];

?>

<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Refigeracion JK - Productos</title>
      
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
         integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

      <!-- JQuery Script -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

   </head>

   <?php include("../Adiciones/navbar.php"); ?>

   <body>
      <div class="container my-5">
         <div class="row d-flex mx-1 my-2">
            <div class="form-group row mx-2 my-0 w-100">

               <h5 class="my-2 mr-2"><?php echo "$cliente->nombre $cliente->apellido"; ?></h5>

               <input type="hidden" value="<?php echo $cliente->id; ?>" id="clienteId">
               <input type="hidden" value="#" id="productoId">
               <input type="hidden" value="#" id="servicioId">

               <div class="my-auto">
                  <button id="botonVentanaModal" type="button" class="btn btn-sm btn-primary mr-2" data-toggle="modal"
                     data-target="#carritoModal">
                     Carrito
                  </button>
                  <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown"
                     aria-haspopup="true" aria-expanded="false" id="dropdownTablas"
                     style="width: 160px;">Facturas</button>
                  <div class="dropdown-menu">
                     <option value="facturas" class="dropdown-item dropdownTablasLink">Facturas</option>
                     <option value="productos" class="dropdown-item dropdownTablasLink">Productos</option>
                     <option value="servicios" class="dropdown-item dropdownTablasLink">Servicios</option>
                  </div>
               </div>

            </div>

            <!-- Ventana modal de carrito de compras -->
            <div class="modal fade border-dark" id="carritoModal" tabindex="-1" role="dialog"
               aria-labelledby="tituloCarritoModal" aria-hidden="true">
               <div class="modal-dialog modal-dialog-scrollable" role="document">
                  <div class="modal-content">

                     <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="tituloCarritoModal">Carrito de compras</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>

                     <div class="modal-body" id="modalBody">

                        <div>
                           <p><strong>No hay productos en el carrito...</strong></p>
                        </div>
                        
                     </div>

                     <div class="modal-footer my-0 py-3 pb-0">
                        <button type="button" class="btn btn-primary" id="botonTerminarCompra">Terminar compra</button>
                        <button type="button" class="btn btn-danger" id="botonVaciarCarrito">Vaciar carrito</button>
                        <button type="button" class="btn btn-secondary" id="botonCerrarCarrito" data-dismiss="modal">
                           Cerrar
                        </button>
                     </div>
                  </div>
               </div>
            </div>

            <!--
            <button id="botonVentanaModalAux" type="hidden" data-toggle="modal" data-target="#ventanaModalAux">
               ...
            </button>            

            <!-- Ventana modal auxiliar 
            <div class="modal fade border-dark" id="ventanaModalAux" tabindex="-1" aria-labelledby="tituloVentanaModalAux"
               role="dialog" aria-hidden="true">
               <div class="modal-dialog modal-dialog-scrollable" role="document">
                  <div class="modal-content">

                     <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="tituloVentanaModalAux">...</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>

                     <div class="modal-body" id="ventanaModalAuxBody">

                     </div>

                     <div class="modal-footer my-0 py-3 pb-0">
                        <button type="button" class="btn btn-primary" id="botonAceptarAux">Aceptar</button>
                        <button type="button" class="btn btn-secondary" id="botonCancelarAux" data-dismiss="modal">
                           Cancelar
                        </button>
                     </div>
                  </div>
               </div>
            </div>
            -->

         </div>

         <div id="containerTabla"></div>

      </div>

      <?php include("../Adiciones/bootstrapScripts.php"); ?>

      <!-- Own Script -->
      <script src="../../Js/scriptComprasCliente.js" language="JavaScript" type="text/javascript"></script>
   </body>
</html>

