
<div class="row d-flex justify-content-start mx-0 my-2">
   <div class="form-group row mx-0 my-0">

      <div class="btn-group ml-2">
         <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" id="dropdownBusqueda"
            style="width: 160px;">Placa</button>
         <div class="dropdown-menu">
            <option value="placa" class="dropdown-item dropdownLink">Placa</option>
            <option value="modelo" class="dropdown-item dropdownLink">Modelo</option>
            <option value="fecha_hora_entrada" class="dropdown-item dropdownLink">Entrada</option>
            <option value="fecha_hora_salida" class="dropdown-item dropdownLink">Salida</option>
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
               <h5 class="modal-title text-white" id="vetanaModalAuxTitulo">Eliminar registro</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <div class="modal-body">
               <p>¿En realidad quiere eliminar este registro?</p>
            </div>

            <input type="hidden" id="idEliminar">
            <div class="modal-footer">
               <button type="button" class="btn btn-danger" id="botonAceptarAux">Eliminar</button>
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
         <th scope="col" class="font-weight-normal">Placa</th>
         <th scope="col" class="font-weight-normal">Modelo</th>
         <th scope="col" class="font-weight-normal">Entrada</th>
         <th scope="col" class="font-weight-normal">Salida</th>
         <th scope="col" class="font-weight-normal"></th>
      </tr>
   </thead>
   <tbody id="cuerpoTabla"></tbody>
</table>

<div id="paginacion" class="text-center mt-5"></div>

<script src="../../Js/scriptTablaRegistroVehiculos.js" language="JavaScript" type="text/javascript"></script>

