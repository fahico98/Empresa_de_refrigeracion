
<?php

session_start();

if(!isset($_SESSION["nombre"])){
   header("Location: http://localhost/WampCode/Yurani_Duque");
}

?>

<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Refigeracion JK - Registro vehiculos</title>
      
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
            <div class="form-group row mx-1 my-0 w-100">

               <!--
               <input type="hidden" value="<?php //echo $cliente->id; ?>" id="clienteId">
               <input type="hidden" value="<?php //echo $_SESSION['id']; ?>" id="empleadoId">
               <input type="hidden" value="#" id="productoId">
               <input type="hidden" value="#" id="servicioId">
               -->

               <div class="my-auto">
                  <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown"
                     aria-haspopup="true" aria-expanded="false" id="dropdownTablas"
                     style="width: 160px;">Registros</button>
                  <div class="dropdown-menu">
                     <option value="registros" class="dropdown-item dropdownTablasLink">Registros</option>
                     <option value="clientes" class="dropdown-item dropdownTablasLink">Clientes</option>
                  </div>
               </div>

            </div>

            <!-- Ventana modal de carrito de compras
            <div class="modal fade border-dark bd-example-modal-lg" tabindex="-1" role="dialog" id="carritoModal"
               aria-labelledby="tituloCarritoModal" aria-hidden="true">
               <div class="modal-dialog modal-lg modal-dialog-scrollable">
                  <div class="modal-content">

                     <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="tituloCarritoModal">Carrito de compras</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>

                     <div class="modal-body" id="modalCarritoBody">
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
            -->

         </div>

         <div id="containerTabla"></div>

      </div>

      <?php include("../Adiciones/bootstrapScripts.php"); ?>

      <!-- Own Script -->
      <script src="../../Js/scriptRegistroVehiculos.js" language="JavaScript" type="text/javascript"></script>
   </body>
</html>

