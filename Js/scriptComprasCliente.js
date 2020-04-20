
var carrito = [];
var costoFactura = 0;

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

   $("#botonCarritoModal").on("click", function(evento){
      evento.preventDefault();
      if(carrito.length > 0){
         $("#botonTerminarCompra").attr("disabled", false);
         $("#botonVaciarCarrito").attr("disabled", false);
      }else{
         $("#botonTerminarCompra").attr("disabled", true);
         $("#botonVaciarCarrito").attr("disabled", true);
      }
   });

   $("#botonVaciarCarrito").on("click", function(evento){
      evento.preventDefault();
      costoFactura = 0;
      carrito = [];
      $("#botonCerrarCarrito").trigger("click");
      actualizarCarrito();
   });

   $("#botonTerminarCompra").on("click", function(evento){
      evento.preventDefault();
      terminarCompra();
   });
});

function terminarCompra(){
   $.ajax({
      type: "GET",
      dataType: "json",
      async: false,
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/FacturasController.php",
      data: {accion: "insertar", cliente_id: $("#clienteId").val(), costo: costoFactura},
      success: function(response){
         let factura_id = response["LAST_INSERT_ID()"];
         carrito.forEach(function(compra){
            compra.factura_id = factura_id;
            compra.accion = "insertar";
            $.ajax({
               type: "GET",
               async: false,
               url: "http://localhost/WampCode/Yurani_Duque/Controllers/ComprasController.php",
               data: compra
            });
         });
      }
   });
   $("#botonVaciarCarrito").trigger("click");
}

function cargarTabla(tabla){
   $.ajax({
      type: "GET",
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/FacturasController.php",
      data: {accion: "tabla_" + tabla},
      async: false,
      dataType: "html",
      success: function(response){
         $("#containerTabla").html(response);
      }
   });
}

function actualizarCarrito(){
   if(carrito.length > 0){
      $("#botonTerminarCompra").attr("disabled", false);
      $("#botonVaciarCarrito").attr("disabled", false);
      let table = $("<table class='table-sm w-100'>");
      let thead = $(
         "<thead><tr>" +
            "<th><small class='font-weight-bold'>producto/servicio</small></th>" +
            "<th><small class='font-weight-bold'>cantidad</small></th>" +
            "<th><small class='font-weight-bold'>costo unitario</small></th>" +
            "<th><small class='font-weight-bold'>costo total</small></th>"
      );
      table.append(thead);
      carrito.forEach(function(elemento){
         table.append(
            "<tr>" +
               "<td><small>" + elemento.nombre + "</small></td>" +
               "<td><small>" + elemento.cantidad + "</small></td>" +
               "<td><small>" + elemento.costoUnitario + "</small></td>" +
               "<td><small>" + elemento.costoTotal + "</small></td>" +
            "</tr>"
         );
      });
      table.append(
         "<tr>" +
            "<td></td><td></td><td></td>" +
            "<td><small class='font-weight-bold'>" + costoFactura + "</small></td>" +
         "</tr>"
      );
      $("#modalCarritoBody").html(table);
   }else{
      $("#botonTerminarCompra").attr("disabled", true);
      $("#botonVaciarCarrito").attr("disabled", true);
      $("#modalCarritoBody").html(
         "<div>" +
            "<p><strong>No hay productos en el carrito...</strong></p>" +
         "</div>"
      );
   }
}
