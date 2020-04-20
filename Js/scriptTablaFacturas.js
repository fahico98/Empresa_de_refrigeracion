
paginaActual = 1;

$(document).ready(function(){

   cargarFacturas();

   $(".linkEliminar").on("click", function(evento){
      evento.preventDefault();
      $("#botonAceptarAux").removeClass().addClass("btn btn-danger").text("Eliminar");
      $("#botonCancelarAux").attr("hidden", false);
      $("#idEliminar").val($(this).attr("id"));
      $("#vetanaModalAuxTitulo").text("Eliminar factura");
      $("#contenidoVentanaModalAux").html(
         "<p>Realmente quiere eliminar todos los datos relacionados con esta factura ?</p>"
      );
      $("#botonVentanaModalAux").trigger("click");
   });

   $(".linkVer").on("click", function(evento){
      evento.preventDefault();
      let factura = cargarFacturaPorId($(this).attr("id"));
      $("#botonAceptarAux").removeClass().addClass("btn btn-primary").text("Aceptar");
      $("#botonCancelarAux").attr("hidden", true);
      $("#idEliminar").val("");
      $("#vetanaModalAuxTitulo").text("Factura");
      $("#contenidoVentanaModalAux").html(
         "<p>Datos de la factura...!</p>"
      );
      $("#botonVentanaModalAux").trigger("click");
   });

   $("#botonAceptarAux").on("click", function(evento){
      evento.preventDefault();
      if($("#vetanaModalAuxTitulo").text().localeCompare("Eliminar factura") == 0){
         eliminarFactura();
         paginaActual = 1;
         $("#idEliminar").val("");
         cargarFacturas("fecha_hora", $("#entradaBusqueda").val(), paginaActual);
      }
      $("#botonCancelarAux").trigger("click");
   });

   $("#entradaBusqueda").on("keyup", function(evento){
      evento.preventDefault();
      let valor = $(this).val();
      cargarFacturas("fecha_hora", valor, 1);
   });

   $(document).on("click", ".botonPagina", function(evento){
      evento.preventDefault();
      let pagina = $(this).attr("id");
      let valor = $("#entradaBusqueda").val();
      paginaActual = pagina;
      cargarFacturas("fecha_hora", valor, pagina);
   });
});

function eliminarFactura(){
   $.ajax({
      type: "GET",
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/FacturasController.php",
      data: {
         id: $("#idEliminar").val(),
         accion: "eliminar"
      }
   });
}

function cargarFacturaPorId(id){
   let salida = null;
   $.ajax({
      type: "GET",
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/FacturasController.php",
      data: {id: id, accion: "seleccionar_id"},
      dataType: "json",
      async: false,
      success: function(respuesta){
         salida = respuesta != "null" ? respuesta : null;
      }
   });
   return salida;
}

function recargarFacturas(){
   cargarFacturas("fecha_hora", $("#entradaBusqueda").val(), paginaActual);
}

function cargarFacturas(parametro = "id", valor = "", pagina = 1){
   let data = {
      accion: "seleccionar",
      parametro: parametro,
      valor: valor,
      pagina: pagina,
      cliente_id: $("#clienteId").val()
   };
   $.ajax({
      type: "GET",
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/FacturasController.php",
      data: data,
      dataType: "html",
      success: function(response){
         $("#cuerpoTabla").html(response);
      }, async: false
   });
   data.accion = "paginacion";
   $.ajax({
      type: "GET",
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/FacturasController.php",
      data: data,
      dataType: "html",
      success: function(response){
         $("#paginacion").html(response);
      }, async: false
   });
   $("td").addClass("align-middle mx-0 px-0");
   $("th").addClass("align-middle mx-0 px-0");
}