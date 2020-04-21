

<?php

   session_start();

   if(isset($_SESSION["nombre"])){
      if($_SESSION["rol"] == "general"){
         header("Location: http://localhost/WampCode/Yurani_Duque/Views/dashboard.php");
      }
   }else{header("Location: http://localhost/WampCode/Yurani_Duque");}
   
?>

<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Refigeracion JK - Empleados</title>
      
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
         integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

      <!-- JQuery Script -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

   </head>

   <?php include("../Adiciones/navbar.php"); ?>

   <body>
      <div class="container mb-3 mt-5">
         <div class="row d-flex justify-content-center">
            <h2 class="my-3">Epleados</h2>
         </div>
         <div class="row d-flex justify-content-start mx-1 my-2">
            <div class="form-group row mx-2 my-0">

               <!-- Boton para gregar un nuevo empleado -->
               <button id="botonVentanaModal" type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                  data-target="#ventanaModal">
                  Agregar empleado
               </button>

               <div class="btn-group ml-2">
                  <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown"
                     aria-haspopup="true" aria-expanded="false" id="dropdownBusqueda"
                     style="width: 160px;">Documento</button>
                  <div class="dropdown-menu">
                     <option value="documento" class="dropdown-item dropdownLink">Documento</option>
                     <option value="nombre" class="dropdown-item dropdownLink">Nombre</option>
                     <option value="apellido" class="dropdown-item dropdownLink">Apellido</option>
                  </div>
               </div>
               <div class="col ml-2 px-0 w-100">
                  <input type="text" class="form-control form-control-sm" id="entradaBusqueda" style="width: 300px;">
               </div>
            </div>

            <!-- Formulario en ventana modal -->
            <div class="modal fade border-dark" id="ventanaModal" tabindex="-1" role="dialog"
               aria-labelledby="tituloVentanaModal" aria-hidden="true">
               <div class="modal-dialog modal-dialog-scrollable" role="document">

                  <div class="modal-content">
                     <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="tituloVentanaModal">Registrar nuevo empleado</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <form id="formulario" autocomplete="off">
                           <div class="form-group input-group-sm">
                              <label for="entradaNombre">Nombre</label>
                              <input type="text" class="form-control" name="nombre" id="entradaNombre"
                                 aria-describedby="subEntradaNombre" placeholder="Nombre del empleado">
                              <small id="subEntradaNombre" style="color: red;" class="helpText mb-0 pb-0"></small>
                           </div>
                           <div class="form-group input-group-sm">
                              <label for="entradaApellido">Apellido</label>
                              <input type="text" class="form-control" name="apellido" id="entradaApellido"
                                 aria-describedby="subEntradaApellido" placeholder="Apellido del empleado">
                              <small id="subEntradaApellido" style="color: red;" class="helpText mb-0 pb-0"></small>
                           </div>
                           <div class="form-group input-group-sm">
                              <label for="entradaDocumento">Documento</label>
                              <input type="text" class="form-control" name="documento" id="entradaDocumento"
                                 aria-describedby="subEntradaDocumento" placeholder="Número de documento">
                              <small id="subEntradaDocumento" style="color: red;" class="helpText mb-0 pb-0"></small>
                           </div>
                           <div class="form-group input-group-sm">
                              <label for="entradaTelefono">Teléfono</label>
                              <input type="text" class="form-control" name="telefono" id="entradaTelefono"
                                 aria-describedby="subEntradaTelefono" placeholder="Número de telefono">
                              <small id="subEntradaTelefono" style="color: red;" class="helpText mb-0 pb-0"></small>
                           </div>
                           <div class="form-group input-group-sm">
                              <label for="entradaCargo">Cargo</label>
                              <input type="text" class="form-control" name="cargo" id="entradaCargo"
                                 aria-describedby="subEntradaCargo" placeholder="Cargo del empleado">
                              <small id="subEntradaCargo" style="color: red;" class="helpText mb-0 pb-0"></small>
                           </div>
                           <div class="form-group input-group-sm">
                              <label for="entradaSueldo">Sueldo</label>
                              <input type="text" class="form-control" name="sueldo" id="entradaSueldo"
                                 aria-describedby="subEntradaSueldo" placeholder="Sueldo del empleado">
                              <small id="subEntradaSueldo" style="color: red;" class="helpText mb-0 pb-0"></small>
                           </div>

                           <div class="form-group input-group-sm">
                              <label for="entradaRol">Rol</label>
                              <select id="entradaRol" name="rol" class="form-control">
                                 <option value="general"selected>General</option>
                                 <option value="administrador">Administrador</option>
                              </select>
                           </div>
                           <div class="form-group input-group-sm">
                              <label for="entradaUsuario">Nombre de usuario</label>
                              <input type="text" class="form-control" name="usuario" id="entradaUsuario"
                                 aria-describedby="subEntradaUsuario" placeholder="Nombre de usuario">
                              <small id="subEntradaUsuario" style="color: red;" class="helpText mb-0 pb-0"></small>
                           </div>
                           <div class="form-group input-group-sm">
                              <label for="entradaContrasena">Contraseña</label>
                              <input type="password" class="form-control" name="contrasena" id="entradaContrasena"
                                 aria-describedby="subEntradaContrasena" placeholder="Contraseña">
                              <small id="subEntradaContrasena" style="color: red;" class="helpText mb-0 pb-0"></small>
                           </div>
                           <div class="form-group input-group-sm">
                              <label for="entradaReContrasena">Repita la contraseña</label>
                              <input type="password" class="form-control" id="entradaReContrasena"
                                 aria-describedby="subEntradaReContrasena" placeholder="Contraseña">
                              <small id="subEntradaReContrasena" style="color: red;" class="helpText mb-0 pb-0"></small>
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
                        <h5 class="modal-title text-white" id="vetanaModalAuxTitulo">Eliminar empleado</h5>
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
         <table class="table table-sm">
            <thead class="bg-primary text-white text-center align-middle">
               <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Documento</th>
                  <th scope="col">Teléfono</th>
                  <th scope="col">Cargo</th>
                  <th scope="col">Sueldo</th>
                  <th scope="col"></th>
               </tr>
            </thead>
            <tbody id="cuerpoTabla"></tbody>
         </table>
         <div id="paginacion" class="text-center mt-5"></div>
      </div>

      <?php include("../Adiciones/bootstrapScripts.php"); ?>

      <!-- Own Script -->
      <script src="../../Js/scriptEmpleados.js" language="JavaScript" type="text/javascript"></script>

   </body>
</html>