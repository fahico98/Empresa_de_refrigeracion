
var carrito = [];

$(document).ready(function(){

   $(".dropdown-item").css("cursor", "pointer");
   $("td").addClass("align-middle mx-0 px-0");
   $("th").addClass("align-middle mx-0 px-0");

   cargarTabla("facturas");

   $(".dropdownTablasLink").on("click", function(evento){
      evento.preventDefault();
      $("#dropdownTablas").text($(this).text());
      cargarTabla($(this).val());
   });

   /*
   cargarProductos("nombre", "", 1);

   $("#formulario").on("submit", function(event){
      event.preventDefault();
      if(validarFormulario()){
         var datosFormulario = new FormData(this);
         if($("#tituloVentanaModal").text() == "Editar empleado"){
            datosFormulario.set("accion", "editar");
            $.ajax({
               type: "POST",
               url: "http://localhost/WampCode/Yurani_Duque/Controllers/EmpleadosController.php",
               d/ata: datosFormulario,
               processData: false,
               contentType: false,
               success: function(){
                  empleadoEnEdicion = null;
                  $("#botonCancelar").trigger("click");
                  recargarEmpleados();
               }, async: false
            });
         }else if($("#tituloVentanaModal").text() == "Registrar nuevo empleado"){
            $.ajax({
               type: "POST",
               url: "http://localhost/WampCode/Yurani_Duque/Controllers/EmpleadosController.php",
               d/ata: datosFormulario,
               processData: false,
               contentType: false,
               success: function(){
                  $("#botonCancelar").trigger("click");
                  recargarEmpleados();
               }, async: false
            });
         }
      }
   });

   $("#botonEnviar").on("click", function(evento){
      evento.preventDefault();
      $("#formulario").trigger("submit");
   });

   $("#botonCancelar").on("click", function(evento){
      evento.preventDefault();
      empleadoEnEdicion = null;
   });

   $(".dropdownLink").on("click", function(){
      if($(this).text().localeCompare($("#dropdownBusqueda").text()) != 0){
         $("#dropdownBusqueda").text($(this).text());
         $("#entradaBusqueda").val("");
         cargarEmpleados($(this).text(), "", 1);
      }
   });

   $("#entradaBusqueda").on("keyup", function(evento){
      evento.preventDefault();
      let parametro = $("#dropdownBusqueda").text().toLowerCase();
      let valor = $(this).val();
      cargarEmpleados(parametro, valor, 1);
   });

   $("#botonVentanaModal").on("click", function(evento){
      evento.preventDefault();
      reiniciarFormulario();
      $("#tituloVentanaModal").text("Registrar nuevo empleado");
   });

   $("#botonEliminarAux").on("click", function(evento){
      evento.preventDefault();
      eliminarEmpleado($("#idEliminar").val());
      $("#botonCancelarAux").trigger("click");
      cargarEmpleados($("#dropdownBusqueda").text().toLowerCase(), $("#entradaBusqueda").val(), 1);
   });

   $(document).on("click", ".botonPagina", function(evento){
      evento.preventDefault();
      let pagina = $(this).attr("id");
      let parametro = $("#dropdownBusqueda").text().toLowerCase();
      let valor = $("#entradaBusqueda").val();
      paginaActual = pagina;
      cargarEmpleados(parametro, valor, pagina);
   });

   $(document).on("click", ".linkEditar", function(evento){
      evento.preventDefault();
      let empleado = cargarEmpleadoPorParametro("id", $(this).attr("id"));
      empleadoEnEdicion = empleado;
      $("#botonVentanaModal").trigger("click");
      $("#tituloVentanaModal").text("Editar empleado");
      $("#entradaId").val($(this).attr("id"));
      $("#entradaNombre").val(empleado.nombre);
      $("#entradaApellido").val(empleado.apellido);
      $("#entradaDocumento").val(empleado.documento);
      $("#entradaTelefono").val(empleado.telefono);
      $("#entradaCargo").val(empleado.cargo);
      $("#entradaSueldo").val(empleado.sueldo);
      $("#entradaUsuario").val(empleado.usuario);
   });

   $(document).on("click", ".linkEliminar", function(event){
      event.preventDefault();
      let empleado = cargarEmpleadoPorParametro("id", $(this).attr("id"));
      $("#idEliminar").val(empleado.id);
      $("#contenidoVentanaModalAux")
         .html("¿Realmente quiere eliminar al empleado <strong>" + empleado.nombre + " " + empleado.apellido + "</strong>?");
      $("#botonVentanaModalAux").trigger("click");
   });
   */

});

function cargarTabla(tabla){
   $.ajax({
      type: "GET",
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/ComprasController.php",
      data: {accion: "tabla_" + tabla},
      dataType: "html",
      success: function(response){
         $("#containerTabla").html(response);
      }, async: false
   });
}
