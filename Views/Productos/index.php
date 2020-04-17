
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
         <div class="row d-flex justify-content-center">
            <h2 class="my-5">Productos</h2>
         </div>
         <div class="row d-flex justify-content-start mx-1 my-2">
            <div class="form-group row mx-2 my-0">

               <!-- Boton para gregar un nuevo servicio -->
               <button id="botonVentanaModal" type="button" class="btn btn-primary" data-toggle="modal"
                  data-target="#ventanaModal">
                  Agregar producto
               </button>

               <div class="btn-group ml-2">
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                     aria-haspopup="true" aria-expanded="false" id="dropdownBusqueda"
                     style="width: 160px;">Nombre</button>
                  <div class="dropdown-menu">
                     <option value="nombre" class="dropdown-item dropdownLink">Nombre</option>
                     <option value="clase" class="dropdown-item dropdownLink">Clase</option>
                     <option value="marca" class="dropdown-item dropdownLink">Marca</option>
                  </div>
               </div>
               <div class="col ml-2 px-0 w-100">
                  <input type="text" class="form-control" id="entradaBusqueda" style="width: 300px;">
               </div>
            </div>

            <!-- Formulario en ventana modal -->
            <div class="modal fade border-dark" id="ventanaModal" tabindex="-1" role="dialog"
               aria-labelledby="tituloVentanaModal" aria-hidden="true">
               <div class="modal-dialog modal-dialog-scrollable" role="document">

                  <div class="modal-content">
                     <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="tituloVentanaModal">Agregar nuevo producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <form id="formulario" autocomplete="off">

                           <div class="form-group input-group-sm">
                              <label for="entradaNombre">Nombre</label>
                              <input type="text" class="form-control" name="nombre" id="entradaNombre"
                                 aria-describedby="subEntradaNombre" placeholder="Nombre del producto">
                              <small id="subEntradaNombre" style="color: red;" class="helpText mb-0 pb-0"></small>
                           </div>

                           <div class="form-group input-group-sm">
                              <label for="entradaClase">Clase</label>
                              <input type="text" class="form-control" name="clase" id="entradaClase"
                                 aria-describedby="subEntradaClase" placeholder="Clase del producto">
                              <small id="subEntradaClase" style="color: red;" class="helpText mb-0 pb-0"></small>
                           </div>

                           <div class="form-group input-group-sm">
                              <label for="entradaMarca">Marca</label>
                              <input type="text" class="form-control" name="marca" id="entradaMarca"
                                 aria-describedby="subEntradaMarca" placeholder="Marca del producto">
                              <small id="subEntradaMarca" style="color: red;" class="helpText mb-0 pb-0"></small>
                           </div>

                           <div class="form-group input-group-sm">
                              <label for="entradaCantidad">Cantidad</label>
                              <input type="number" class="form-control" name="cantidad" id="entradaCantidad"
                                 aria-describedby="subEntradaCantidad" placeholder="Cantidad de producto">
                              <small id="subEntradaCantidad" style="color: red;" class="helpText mb-0 pb-0"></small>
                           </div>

                           <div class="form-group input-group-sm">
                              <label for="entradaCosto">Costo unitario</label>
                              <input type="text" class="form-control" name="costo_unitario" id="entradaCosto"
                                 aria-describedby="subEntradaCosto" placeholder="Costo unitario del producto">
                              <small id="subEntradaCosto" style="color: red;" class="helpText mb-0 pb-0"></small>
                           </div>

                           <div class="form-group input-group-sm">
                              <label for="entradaObservaciones">Observaciones</label>
                              <textarea rows="6" style="resize: none;" class="form-control" name="observaciones"
                                 id="entradaObservaciones" aria-describedby="subEntradaObservaciones"
                                 placeholder="Observaciones generales...">
                              </textarea>
                              <small id="subEntradaObservaciones" style="color: red;" class="helpText mb-0 pb-0"></small>
                           </div>

                           <input type="hidden" name="accion" value="insertar">
                           <input type="hidden" name="id" id="entradaId">
                        </form>
                     </div>
                     <div class="modal-footer my-0 py-3 pb-0">
                        <button type="button" class="btn btn-primary" id="botonEnviar">Enviar</button>
                        <button type="button" class="btn btn-secondary" id="botonCancelar" data-dismiss="modal">
                           Cancelar
                        </button>
                     </div>
                  </div>
               </div>
            </div>

            <!-- Boton oculto -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ventanaModalAux"
               id="botonVentanaModalAux" hidden>
               Launch demo modal
            </button>

            <!-- Ventana modal auxiliar -->
            <div class="modal fade" id="ventanaModalAux" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
               aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="vetanaModalAuxTitulo">Eliminar producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p id="contenidoVentanaModalAux"></p>
                     </div>
                     <input type="hidden" id="idEliminar">
                     <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="botonEliminarAux">Eliminar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="botonCancelarAux">
                           Cancelar
                        </button>
                     </div>
                  </div>
               </div>
            </div>

         </div>
         <table class="table">
            <thead class="bg-primary text-white text-center align-middle">
               <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Clase</th>
                  <th scope="col">Marca</th>
                  <th scope="col">Cantidad</th>
                  <th scope="col">Costo unitario</th>
                  <th scope="col">Observaciones</th>
                  <th scope="col"></th>
               </tr>
            </thead>
            <tbody id="cuerpoTabla"></tbody>
         </table>
         <div id="paginacion" class="text-center mt-5"></div>
      </div>

      <?php include("../Adiciones/bootstrapScripts.php"); ?>

      <!-- Own Script -->
      <script src="../../Js/scriptProductos.js" language="JavaScript" type="text/javascript"></script>

   </body>
</html>

