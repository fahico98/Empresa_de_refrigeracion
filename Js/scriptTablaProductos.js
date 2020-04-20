
paginaActual = 1;

$(document).ready(function(){
   
   $(".dropdown-item").css("cursor", "pointer");
   $("td").addClass("align-middle mx-0 px-0");
   $("th").addClass("align-middle mx-0 px-0");

   cargarProductos();
   
   $("#entradaBusqueda").on("keyup", function(evento){
      evento.preventDefault();
      let parametro = $("#dropdownBusqueda").text().toLowerCase();
      let valor = $(this).val();
      cargarProductos(parametro, valor, 1);
   });

   $(".dropdownLink").on("click", function(){
      if($(this).text().localeCompare($("#dropdownBusqueda").text()) != 0){
         $("#dropdownBusqueda").text($(this).text());
         $("#entradaBusqueda").val("");
         cargarProductos($(this).text(), "", 1);
      }
   });

   $(".verObservacionesProducto").on("click", function(evento){
      evento.preventDefault();
      let producto = cargarProductoPorParametro("id", $(this).attr("id"));
      let observaciones = producto.observaciones;
      $("#tituloVetanaModalAux").text(producto.nombre);
      $("#botonAceptarAux").text("Aceptar").attr("data-dismiss", "modal");
      $("#botonCancelarAux").attr("hidden", true);
      if(observaciones != null){
         if(observaciones.trim().localeCompare("") == 0){
            $("#contenidoVentanaModalAux").html("<p>" + producto.observaciones + "</p>");
         }else{$("#contenidoVentanaModalAux").html("<p>No hay observaciones...!</p>");}
      }else{$("#contenidoVentanaModalAux").html("<p>No hay observaciones...!</p>");}
      $("#botonVentanaModalAux").trigger("click");
   });

   $("#botonAceptarAux").on("click", function(evento){
      evento.preventDefault();
      if($("#tituloVetanaModalAux").text().localeCompare("Comprar") == 0){
         let cantidad = $("#cantProducto").val();
         let producto = cargarProductoPorParametro("id", $("#productoId").val());
         if(cantidad <= 0){
            $("#subCantProducto").text("Cantidad de producto no valida...");
         }else{
            $("#subCantProducto").text("");
            if(parseInt(producto.cantidad, 10) < cantidad){
               $("#subCantProducto").text("No hay suficiente producto en el inventario para realizar esta compra...");
            }else{
               $("#subCantProducto").text("");
               agregarAlCarrito($("#productoId").val(), producto, cantidad);
               $("#botonCancelarAux").trigger("click");
            }
         }
      }
   });

   $(document).on("click", ".botonPagina", function(evento){
      evento.preventDefault();
      let pagina = $(this).attr("id");
      let parametro = $("#dropdownBusqueda").text().toLowerCase();
      let valor = $("#entradaBusqueda").val();
      paginaActual = pagina;
      cargarProductos(parametro, valor, pagina);
   });

   $(document).on("click", ".linkComprarProducto", function(evento){
      evento.preventDefault();
      $("#productoId").val($(this).attr("id"));
      $("#tituloVetanaModalAux").text("Comprar");
      $("#botonAceptarAux").text("Agregar al carrito").removeAttr("data-dismiss");
      $("#botonCancelarAux").text("Cancelar").attr("hidden", false).attr("data-dismiss", "modal");
      $("#contenidoVentanaModalAux").html(
         "<div class='form-group input-group-sm'>" +
            "<label for='cantProducto'>Cantidad de producto</label>" +
            "<input type='number' class='form-control' id='cantProducto' aria-describedby='subCantProducto' value='0'>" +
            "<small id='subCantProducto' style='color: red;' class='helpText mb-0 pb-0'></small>" +
         "</div>"
      );
      $("#botonVentanaModalAux").trigger("click");
   });
});

function agregarAlCarrito(id, producto, cantidad){
   carrito.push({
      producto_id: id,
      empleado_id: $("#empleadoId").val(),
      nombre: producto.nombre,
      cantidad: parseInt(cantidad, 10),
      costoUnitario: parseInt(producto.costo_unitario, 10),
      costoTotal: parseInt(producto.costo_unitario, 10) * parseInt(cantidad, 10)
   });
   costoFactura += parseInt(producto.costo_unitario, 10) * parseInt(cantidad, 10);
   actualizarCarrito();
}

function cargarProductoPorParametro(parametro, valor){
   let salida = null;
   $.ajax({
      type: "GET",
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/ProductosController.php",
      data: {valor: valor, accion: "seleccionar_" + parametro},
      dataType: "json",
      async: false,
      success: function(respuesta){
         salida = respuesta != "null" ? respuesta : null;
      }
   });
   return salida;
}

function recargarProductos(){
   cargarProductos(
      $("#dropdownBusqueda").text().toLowerCase(),
      $("#entradaBusqueda").val(),
      paginaActual
   );
}

function cargarProductos(parametro = "id", valor = "", pagina = 1){
   let data = {
      accion: "seleccionar",
      parametro: parametro,
      valor: valor,
      pagina: pagina
   };
   $.ajax({
      type: "GET",
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/ProductosController.php",
      data: data,
      dataType: "html",
      async: false,
      success: function(response){
         $("#cuerpoTabla").html(response);
      }
   });
   $(".celdaDeAccion").each(function(index){
      $(this).html(
         "<a href='#' class='text-primary linkComprarProducto' id='" + $(this).attr("id") + "'><small>comprar</small></a>"
      );
   });
   data.accion = "paginacion";
   $.ajax({
      type: "GET",
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/ProductosController.php",
      data: data,
      dataType: "html",
      async: false,
      success: function(response){
         $("#paginacion").html(response);
      }
   });
   $("td").addClass("align-middle mx-0 px-0");
   $("th").addClass("align-middle mx-0 px-0");
}