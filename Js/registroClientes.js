
paginaActual = 1;

$(document).ready(function(){
   
   $(".dropdown-item").css("cursor", "pointer");
   $("td").addClass("align-middle mx-0 px-0");
   $("th").addClass("align-middle mx-0 px-0");

   cargarClientes();

   $("#entradaBusqueda").on("keyup", function(){
      let parametro = $("#dropdownBusqueda").text().toLowerCase();
      let valor = $(this).val();
      cargarClientes(parametro, valor, 1);
   });

   $(".dropdownLink").on("click", function(){
      if($(this).text().localeCompare($("#dropdownBusqueda").text()) != 0){
         $("#dropdownBusqueda").text($(this).text());
         $("#entradaBusqueda").val("");
         cargarClientes($(this).text(), "", 1);
      }
   });

   $("#botonCancelarAux").on("click", function(){
      $("#idRegistrar").val("");
      $("#entradaModeloVehiculo").val("");
   });

   $("#botonAceptarAux").on("click", function(){
      registrarVehiculoCliente();
      crearRegistroVehiculo();
      recargarClientes();
      $("#botonCancelarAux").trigger("click");
   });

   $(document).on("click", ".linkRegistrar", function(evento){
      evento.preventDefault();
      $("#botonVentanaModalAux").trigger("click");
      $("#idRegistrar").val($(this).attr("id"));
   });

   $(document).on("click", ".linkQuitarRegistro", function(evento){
      evento.preventDefault();
      quitarRegistroVehiculoCliente($(this).attr("id"));
      terminarRegistroVehiculo($(this).attr("id"));
      recargarClientes();
   });

   $(document).on("click", ".botonPagina", function(){
      let pagina = $(this).attr("id");
      let parametro = $("#dropdownBusqueda").text().toLowerCase();
      let valor = $("#entradaBusqueda").val();
      paginaActual = pagina;
      cargarClientes(parametro, valor, pagina);
   });


});

function registrarVehiculoCliente(){
   $.ajax({
      type: "GET",
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/ClientesController.php",
      data: {
         id: $("#idRegistrar").val(),
         accion: "registrar"
      },
      async: false
   });
}

function quitarRegistroVehiculoCliente(id){
   $.ajax({
      type: "GET",
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/ClientesController.php",
      data: {id: id, accion: "quitar_registro"},
      async: false
   });
}

function crearRegistroVehiculo(){
   $.ajax({
      type: "GET",
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/RegistroVehiculosController.php",
      data: {
         cliente_id: $("#idRegistrar").val(),
         modelo: $("#entradaModeloVehiculo").val(),
         accion: "insertar"
      },
      async: false
   });

}

function terminarRegistroVehiculo(cliente_id){
   $.ajax({
      type: "GET",
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/RegistroVehiculosController.php",
      data: {
         cliente_id: cliente_id,
         accion: "terminar"
      },
      async: false
   });
}

function recargarClientes(){
   cargarClientes(
      $("#dropdownBusqueda").text().toLowerCase(),
      $("#entradaBusqueda").val(),
      paginaActual
   );
}

function cargarClientes(parametro = "nombre", valor = "", pagina = 1){
   let data = {
      accion: "seleccionar_estados",
      parametro: parametro,
      valor: valor,
      pagina: pagina
   };
   $.ajax({
      type: "GET",
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/ClientesController.php",
      data: data,
      dataType: "html",
      success: function(response){
         $("#cuerpoTabla").html(response);
      }, async: false
   });
   data.accion = "paginacion";
   $.ajax({
      type: "GET",
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/ClientesController.php",
      data: data,
      dataType: "html",
      success: function(response){
         $("#paginacion").html(response);
      }, async: false
   });
   $("td").addClass("align-middle mx-0 px-0");
   $("th").addClass("align-middle mx-0 px-0");
}

/*
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
      d/ata: {valor: valor, accion: "seleccionar_" + parametro},
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
      d/ata: data,
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
      d/ata: data,
      dataType: "html",
      async: false,
      success: function(response){
         $("#paginacion").html(response);
      }
   });
   $("td").addClass("align-middle mx-0 px-0");
   $("th").addClass("align-middle mx-0 px-0");
}
*/