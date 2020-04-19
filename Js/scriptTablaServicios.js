
$(document).ready(function(){

   $(".dropdown-item").css("cursor", "pointer");
   $("td").addClass("align-middle mx-0 px-0");
   $("th").addClass("align-middle mx-0 px-0");

   cargarServicios();

   $("#entradaBusqueda").on("keyup", function(evento){
      evento.preventDefault();
      let parametro = $("#dropdownBusqueda").text().toLowerCase();
      let valor = $(this).val();
      cargarSercivios(parametro, valor, 1);
   });

   $(".dropdownLink").on("click", function(){
      if($(this).text().localeCompare($("#dropdownBusqueda").text()) != 0){
         $("#dropdownBusqueda").text($(this).text());
         $("#entradaBusqueda").val("");
         cargarServicios($(this).text(), "", 1);
      }
   });

   $(".linkComprarServicio").on("click", function(evento){
      evento.preventDefault();
      $("#servicioId").val($(this).attr("id"));
      $("#tituloVetanaModalAux").text("Comprar");
      $("#botonAceptarAux").text("Agregar al carrito").removeAttr("data-dismiss");
      $("#botonCancelarAux").text("Cancelar").attr("hidden", false).attr("data-dismiss", "modal");
      $("#contenidoVentanaModalAux").html(
         "<div class='form-group input-group-sm'>" +
            "<label for='cantServicio'>Cantidad de servicio</label>" +
            "<input type='number' class='form-control' id='cantServicio' aria-describedby='subCantServicio' value='0'>" +
            "<small id='subCantServicio' style='color: red;' class='helpText mb-0 pb-0'></small>" +
         "</div>"
      );
      $("#botonVentanaModalAux").trigger("click");
   });

   $(".verObservacionesServicio").on("click", function(evento){
      evento.preventDefault();
      let servicio = cargarServicioPorParametro("id", $(this).attr("id"));
      let observaciones = servicio.observaciones;
      $("#tituloVetanaModalAux").text(servicio.nombre);
      $("#botonAceptarAux").text("Aceptar").attr("data-dismiss", "modal");
      $("#botonCancelarAux").attr("hidden", true);
      if(observaciones != null){
         if(observaciones.trim().localeCompare("") == 0){
            $("#contenidoVentanaModalAux").html("<p>" + servicio.observaciones + "</p>");
         }else{$("#contenidoVentanaModalAux").html("<p>No hay observaciones...!</p>");}
      }else{$("#contenidoVentanaModalAux").html("<p>No hay observaciones...!</p>");}
      $("#botonVentanaModalAux").trigger("click");
   });

   $("#botonAceptarAux").on("click", function(evento){
      evento.preventDefault();
      if($("#tituloVetanaModalAux").text().localeCompare("Comprar") == 0){
         let cantidad = $("#cantServicio").val();
         let servicio = cargarServicioPorParametro("id", $("#servicioId").val());
         if(cantidad <= 0){
            $("#subCantServicio").text("Cantidad de servicios no valida...");
         }else{
            $("#subCantServicio").text("");
            agregarAlCarrito(servicio, cantidad);
            $("#botonCancelarAux").trigger("click");
         }
      }
   });
});

function agregarAlCarrito(servicio, cantidad){
   carrito.push({
      tipo: "servicio",
      servicio: servicio.nombre,
      cantidad: parseInt(cantidad, 10),
      costoUnitario: parseInt(servicio.costo, 10),
      costoTotal: parseInt(servicio.costo, 10) * parseInt(cantidad, 10)
   });
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


function cargarServicios(parametro = "id", valor = "", pagina = 1){

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

   $(".celdaDeAccion").each(function(index){
      $(this).html(
         "<a href='#' class='text-primary linkComprarServicio' id='" + $(this).attr("id") + "'><small>Comprar</small></a>"
      );
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