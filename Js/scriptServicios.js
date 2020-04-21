
var paginaActual = 1;
var servicioEnEdicion = null;

var arregloEntradas = {
   "Nombre" : $("#entradaNombre"),
   "Tipo" : $("#entradaTipo"),
   "Costo" : $("#entradaCosto"),
   "Observaciones" : $("#entradaObservaciones")
};

$(document).ready(function(){

   $(".dropdown-item").css("cursor", "pointer");
   $("td").addClass("align-middle mx-0 px-0");
   $("th").addClass("align-middle mx-0 px-0");

   cargarServicios("nombre", "", 1);

   $("#formulario").on("submit", function(event){
      event.preventDefault();
      if(validarFormulario()){
         var datosFormulario = new FormData(this);
         if($("#tituloVentanaModal").text() == "Editar servicio"){
            datosFormulario.set("accion", "editar");
            $.ajax({
               type: "POST",
               url: "http://localhost/WampCode/Yurani_Duque/Controllers/ServiciosController.php",
               data: datosFormulario,
               processData: false,
               contentType: false,
               success: function(){
                  servicioEnEdicion = null;
                  $("#botonCancelar").trigger("click");
                  recargarServicios();
               }, async: false
            });
         }else if($("#tituloVentanaModal").text() == "Registrar nuevo servicio"){
            $.ajax({
               type: "POST",
               url: "http://localhost/WampCode/Yurani_Duque/Controllers/ServiciosController.php",
               data: datosFormulario,
               processData: false,
               contentType: false,
               success: function(){
                  $("#botonCancelar").trigger("click");
                  recargarServicios();
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
      servicioEnEdicion = null;
   });

   $(".dropdownLink").on("click", function(){
      if($(this).text().localeCompare($("#dropdownBusqueda").text()) != 0){
         $("#dropdownBusqueda").text($(this).text());
         $("#entradaBusqueda").val("");
         cargarServicios($(this).text(), "", 1);
      }
   });

   $("#entradaBusqueda").on("keyup", function(evento){
      evento.preventDefault();
      let parametro = $("#dropdownBusqueda").text().toLowerCase();
      let valor = $(this).val();
      cargarServicios(parametro, valor, 1);
   });

   $("#botonVentanaModal").on("click", function(){
      reiniciarFormulario();
      $("#tituloVentanaModal").text("Registrar nuevo servicio");
   });

   $("#botonAceptarAux").on("click", function(evento){
      evento.preventDefault();
      if($(this).text().localeCompare("Eliminar") == 0){
         eliminarServicio($("#idEliminar").val());
         $("#botonCancelarAux").trigger("click");
         cargarServicios($("#dropdownBusqueda").text().toLowerCase(), $("#entradaBusqueda").val(), 1);
      }
   });

   $(document).on("click", ".verObservacionesServicio", function(evento){
      evento.preventDefault();
      let servicio = cargarServicioPorParametro("id", $(this).attr("id"));
      let observaciones = servicio.observaciones;
      $("#vetanaModalAuxTitulo").text(servicio.nombre);
      $("#botonAceptarAux").text("Aceptar").attr("data-dismiss", "modal").removeClass().addClass("btn btn-primary");
      $("#botonCancelarAux").attr("hidden", true);
      if(observaciones != null){
         if(observaciones.trim().localeCompare("") != 0){
            $("#contenidoVentanaModalAux").html("<p>" + servicio.observaciones + "</p>");
         }else{$("#contenidoVentanaModalAux").html("<p>No hay observaciones...!</p>");}
      }else{$("#contenidoVentanaModalAux").html("<p>No hay observaciones...!</p>");}
      $("#botonVentanaModalAux").trigger("click");
   });

   $(document).on("click", ".botonPagina", function(evento){
      evento.preventDefault();
      let pagina = $(this).attr("id");
      let parametro = $("#dropdownBusqueda").text().toLowerCase();
      let valor = $("#entradaBusqueda").val();
      paginaActual = pagina;
      cargarServicios(parametro, valor, pagina);
   });

   $(document).on("click", ".linkEditar", function(evento){
      evento.preventDefault();
      let servicio = cargarServicioPorParametro("id", $(this).attr("id"));
      servicioEnEdicion = servicio;
      $("#botonVentanaModal").trigger("click");
      $("#tituloVentanaModal").text("Editar servicio");
      $("#entradaId").val($(this).attr("id"));
      $("#entradaNombre").val(servicio.nombre);
      $("#entradaTipo").val(servicio.tipo);
      $("#entradaCosto").val(servicio.costo_unitario);
      $("#entradaObservaciones").val(servicio.observaciones);
   });

   $(document).on("click", ".linkEliminar", function(event){
      event.preventDefault();
      let servicio = cargarServicioPorParametro("id", $(this).attr("id"));
      $("#idEliminar").val(servicio.id);
      $("#vetanaModalAuxTitulo").text("Eliminar servicio");
      $("#botonAceptarAux").text("Eliminar").attr("data-dismiss", null).removeClass().addClass("btn btn-danger");
      $("#botonCancelarAux").attr("hidden", false);
      $("#contenidoVentanaModalAux")
         .html("¿Realmente quiere eliminar el servicio <strong>" + servicio.nombre + "</strong>?");
      $("#botonVentanaModalAux").trigger("click");
   });
});

function recargarServicios(){
   cargarServicios(
      $("#dropdownBusqueda").text().toLowerCase(),
      $("#entradaBusqueda").val(),
      paginaActual
   );
}

function cargarServicios(parametro, valor, pagina){

   let data = {
      accion: "seleccionar",
      parametro: parametro,
      valor: valor,
      pagina: pagina
   };

   $.ajax({
      type: "GET",
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/ServiciosController.php",
      data: data,
      dataType: "html",
      success: function(response){
         $("#cuerpoTabla").html(response);
      }, async: false
   });

   data.accion = "paginacion";

   $.ajax({
      type: "GET",
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/ServiciosController.php",
      data: data,
      dataType: "html",
      success: function(response){
         $("#paginacion").html(response);
      }, async: false
   });

   $("td").addClass("align-middle mx-0 px-0");
   $("th").addClass("align-middle mx-0 px-0");
}

function cargarServicioPorParametro(parametro, valor){
   let salida = null;
   $.ajax({
      type: "GET",
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/ServiciosController.php",
      data: {valor: valor, accion: "seleccionar_" + parametro},
      dataType: "json",
      async: false,
      success: function(respuesta){
         salida = respuesta != "null" ? respuesta : null;
      }
   });
   return salida;
}

function eliminarServicio(id){
   $.ajax({
      type: "GET",
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/ServiciosController.php",
      data: {id: id, accion: "eliminar"},
      async: false
   });
}

function reiniciarFormulario(){
   for(var [llave, entrada] of Object.entries(arregloEntradas)){
      $("#subEntrada" + llave).text("");
      entrada.val("");
   }
}

function validarFormulario(){
   var patronNumerico = /[0-9]{1,11}$/;
   var patronAlfanumerico = /[0-9A-Za-z\s]+$/;
   var salida = true;
   for(var [llave, entrada] of Object.entries(arregloEntradas)){
      let texto = entrada.val();
      if(texto.localeCompare("") == 0 && llave.localeCompare("Observaciones") != 0){
         $("#subEntrada" + llave).text("[*] Este campo es obligatorio.");
         salida = false;
      }else{
         if(llave.localeCompare("Nombre") == 0){
            if(!patronAlfanumerico.test(texto)){
               $("#subEntradaNombre").text("[*] El nombre del servicio solo debe contener caracteres alfabéticos.");
               salida = false;
            }else{$("#subEntradaNombre").text("");}
         }else if(llave.localeCompare("Tipo") == 0){
            if(!patronAlfanumerico.test(texto)){
               $("#subEntradaTipo").text("[*] El tipo del servicio solo debe contener caracteres alfabéticos.");
               salida = false;
            }else{$("#subEntradaTipo").text("");}
         }else if(llave.localeCompare("Costo") == 0){
            if(!patronNumerico.test(texto)){
               $("#subEntradaCosto").text("[*] El costo del servicio solo debe contener números.");
               salida = false;
            }else{$("#subEntradaCosto").text("");}
         }
      }
   }
   return salida;
}
