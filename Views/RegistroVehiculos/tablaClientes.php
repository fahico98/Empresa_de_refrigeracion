
<div class="row d-flex justify-content-start mx-0 my-2">
   <div class="form-group row mx-0 my-0">

      <div class="btn-group ml-2">
         <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" id="dropdownBusqueda"
            style="width: 160px;">Nombre</button>
         <div class="dropdown-menu">
            <option value="nombre" class="dropdown-item dropdownLink">Nombre</option>
            <option value="documento" class="dropdown-item dropdownLink">Documento</option>
            <option value="placa" class="dropdown-item dropdownLink">Placa</option>
         </div>
      </div>

      <div class="col ml-2 px-0 w-100">
         <input type="text" class="form-control form-control-sm" id="entradaBusqueda" style="width: 300px;">
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
               <h5 class="modal-title text-white" id="vetanaModalAuxTitulo">Registro de vehiculo</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <div class="modal-body">
               <div class="form-group input-group-sm">
                  <label for="entradaModeloVehiculo">Modelo del vehiculo</label>
                  <input type="text" class="form-control" name="direccion" id="entradaModeloVehiculo"
                     aria-describedby="subEntradaModeloVehiculo" placeholder="Modelos del vehiculo">
                  <small id="subEntradaModeloVehiculo" style="color: red;" class="helpText mb-0 pb-0"></small>
               </div>
            </div>

            <input type="hidden" id="idRegistrar">
            <div class="modal-footer">
               <button type="button" class="btn btn-primary" id="botonAceptarAux">Registrar</button>
               <button type="button" class="btn btn-secondary" id="botonCancelarAux" data-dismiss="modal">
                  Cancelar
               </button>
            </div>
         </div>
      </div>
   </div>

</div>

<table class="table-sm w-100">
   <thead class="bg-primary text-white text-center align-middle">
      <tr>
         <th scope="col" class="font-weight-normal">Id</th>
         <th scope="col" class="font-weight-normal">Nombre</th>
         <th scope="col" class="font-weight-normal">Documento</th>
         <th scope="col" class="font-weight-normal">Placa</th>
         <th scope="col" class="font-weight-normal">Vehiculo registrado</th>
         <th scope="col" class="font-weight-normal"></th>
      </tr>
   </thead>
   <tbody id="cuerpoTabla"></tbody>
</table>

<div id="paginacion" class="text-center mt-5"></div>

<script src="../../Js/registroClientes.js" language="JavaScript" type="text/javascript"></script>

