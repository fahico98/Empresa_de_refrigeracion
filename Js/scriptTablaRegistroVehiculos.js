
paginaActual = 1;

$(document).ready(function(){
   
   $(".dropdown-item").css("cursor", "pointer");
   $("td").addClass("align-middle mx-0 px-0");
   $("th").addClass("align-middle mx-0 px-0");

   cargarRegistros();
   
   $("#entradaBusqueda").on("keyup", function(){
      let parametro = "";
      let valor = $(this).val();
      if($("#dropdownBusqueda").text().localeCompare("Entrada") == 0){
         parametro = "fecha_hora_entrada";
      }else if($("#dropdownBusqueda").text().localeCompare("Salida") == 0){
         parametro = "fecha_hora_salida";
      }else{
         parametro = $("#dropdownBusqueda").text().toLowerCase();
      }
      cargarRegistros(parametro, valor, 1);
   });

   $(".dropdownLink").on("click", function(){
      if($(this).text().localeCompare($("#dropdownBusqueda").text()) != 0){
         let parametro = "";
         if($(this).text().localeCompare("Entrada") == 0){
            parametro = "fecha_hora_entrada";
         }else if($(this).text().localeCompare("Salida") == 0){
            parametro = "fecha_hora_salida";
         }else{
            parametro = $(this).text().toLowerCase();
         }
         $("#dropdownBusqueda").text($(this).text());
         $("#entradaBusqueda").val("");
         cargarRegistros(parametro, "", 1);
      }
   });

   $("#botonCancelarAux").on("click", function(){
      $("#idEliminar").val("");
   });

   $("#botonAceptarAux").on("click", function(){
      eliminarRegistro();
      recargarRegistros();
      $("#botonCancelarAux").trigger("click");
   });

   $(document).on("click", ".linkEliminar", function(){
      $("#idEliminar").val($(this).attr("id"));
      $("#botonVentanaModalAux").trigger("click");
   });

   $(document).on("click", ".botonPagina", function(){
      let parametro = "";
      let valor = $("#entradaBusqueda").val();
      let pagina = $(this).attr("id");
      paginaActual = pagina;
      if($(this).text().localeCompare("Entrada") == 0){
         parametro = "fecha_hora_entrada";
      }else if($(this).text().localeCompare("Salida") == 0){
         parametro = "fecha_hora_salida";
      }else{
         parametro = $(this).text().toLowerCase();
      }
      cargarRegistros(parametro, valor, pagina);
   });
});

function eliminarRegistro(){
   $.ajax({
      type: "GET",
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/RegistroVehiculosController.php",
      data: {
         id: $("#idEliminar").val(),
         accion: "eliminar"
      },
      async: false
   });
}

function recargarRegistros(){
   let parametro = "";
   let valor = $("#entradaBusqueda").val();
   if($("#dropdownBusqueda").text().localeCompare("Entrada") == 0){
      parametro = "hora_fecha_entrada";
   }else if($("#dropdownBusqueda").text().localeCompare("Salida") == 0){
      parametro = "hora_fecha_salida";
   }else{
      parametro = $("#dropdownBusqueda").text().toLowerCase();
   }
   cargarRegistros(parametro, valor, paginaActual);
}

function cargarRegistros(parametro = "id", valor = "", pagina = 1){
   let data = {
      accion: "seleccionar",
      parametro: parametro,
      valor: valor,
      pagina: pagina
   };
   $.ajax({
      type: "GET",
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/RegistroVehiculosController.php",
      data: data,
      dataType: "html",
      async: false,
      success: function(response){
         $("#cuerpoTabla").html(response);
      }
   });
   data.accion = "paginacion";
   $.ajax({
      type: "GET",
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/RegistroVehiculosController.php",
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
