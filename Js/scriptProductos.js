
var paginaActual = 1;

var arregloEntradas = {
   "Nombre" : $("#entradaNombre"),
   "Clase" : $("#entradaClase"),
   "Marca" : $("#entradaMarca"),
   "Cantidad" : $("#entradaCantidad"),
   "Costo" : $("#entradaCosto"),
   "Observaciones" : $("#entradaObservaciones")
};

$(document).ready(function(){

   $(".dropdown-item").css("cursor", "pointer");
   $("td").addClass("align-middle mx-0 px-0");
   $("th").addClass("align-middle mx-0 px-0");

   cargarProductos("nombre", "", 1);

   $("#formulario").on("submit", function(event){
      event.preventDefault();
      if(validarFormulario()){
         var datosFormulario = new FormData(this);
         if($("#tituloVentanaModal").text() == "Editar producto"){
            datosFormulario.set("accion", "editar");
            $.ajax({
               type: "POST",
               url: "http://localhost/WampCode/Yurani_Duque/Controllers/ProductosController.php",
               data: datosFormulario,
               processData: false,
               contentType: false,
               success: function(){
                  $("#botonCancelar").trigger("click");
                  recargarProductos();
               }, async: false
            });
         }else if($("#tituloVentanaModal").text() == "Registrar nuevo producto"){
            $.ajax({
               type: "POST",
               url: "http://localhost/WampCode/Yurani_Duque/Controllers/ProductosController.php",
               data: datosFormulario,
               processData: false,
               contentType: false,
               success: function(){
                  $("#botonCancelar").trigger("click");
                  recargarProductos();
               }, async: false
            });
         }
      }
   });

   $("#botonEnviar").on("click", function(evento){
      evento.preventDefault();
      $("#formulario").trigger("submit");
   });

   $(".dropdownLink").on("click", function(){
      if($(this).text().localeCompare($("#dropdownBusqueda").text()) != 0){
         $("#dropdownBusqueda").text($(this).text());
         $("#entradaBusqueda").val("");
         cargarProductos($(this).text(), "", 1);
      }
   });

   $("#entradaBusqueda").on("keyup", function(evento){
      evento.preventDefault();
      let parametro = $("#dropdownBusqueda").text().toLowerCase();
      let valor = $(this).val();
      cargarProductos(parametro, valor, 1);
   });

   $("#botonVentanaModal").on("click", function(){
      reiniciarFormulario();
      $("#tituloVentanaModal").text("Registrar nuevo producto");
   });

   $("#botonEliminarAux").on("click", function(evento){
      evento.preventDefault();
      eliminarProducto($("#idEliminar").val());
      $("#botonCancelarAux").trigger("click");
      cargarProductos($("#dropdownBusqueda").text().toLowerCase(), $("#entradaBusqueda").val(), 1);
   });

   $(document).on("click", ".botonPagina", function(evento){
      evento.preventDefault();
      let pagina = $(this).attr("id");
      let parametro = $("#dropdownBusqueda").text().toLowerCase();
      let valor = $("#entradaBusqueda").val();
      paginaActual = pagina;
      cargarProductos(parametro, valor, pagina);
   });

   $(document).on("click", ".linkEditar", function(evento){
      evento.preventDefault();
      let producto = cargarProductoPorParametro("id", $(this).attr("id"));
      $("#botonVentanaModal").trigger("click");
      $("#tituloVentanaModal").text("Editar producto");
      $("#entradaId").val($(this).attr("id"));
      $("#entradaNombre").val(producto.nombre);
      $("#entradaClase").val(producto.clase);
      $("#entradaMarca").val(producto.marca);
      $("#entradaCosto").val(producto.costo);
      $("#entradaCantidad").val(producto.cantidad);
      $("#entradaObservaciones").val(producto.observaciones);
   });

   $(document).on("click", ".linkEliminar", function(event){
      event.preventDefault();
      let producto = cargarProductoPorParametro("id", $(this).attr("id"));
      $("#idEliminar").val(producto.id);
      $("#contenidoVentanaModalAux")
         .html("¿Realmente quiere eliminar el producto <strong>" + producto.nombre + "</strong>?");
      $("#botonVentanaModalAux").trigger("click");
   });
});

function recargarProductos(){
   cargarProductos(
      $("#dropdownBusqueda").text().toLowerCase(),
      $("#entradaBusqueda").val(),
      paginaActual
   );
}

function cargarProductos(parametro, valor, pagina){

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
      success: function(response){
         $("#cuerpoTabla").html(response);
      }, async: false
   });

   data.accion = "paginacion";

   $.ajax({
      type: "GET",
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/ProductosController.php",
      data: data,
      dataType: "html",
      success: function(response){
         $("#paginacion").html(response);
      }, async: false
   });

   $("td").addClass("align-middle mx-0 px-0");
   $("th").addClass("align-middle mx-0 px-0");
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

function eliminarProducto(id){
   $.ajax({
      type: "GET",
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/ProductosController.php",
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
      if(texto.localeCompare("") == 0 && llave.localeCompare("Observaciones") != 0 && llave.localeCompare("Marca") != 0
         && llave.localeCompare("Costo") != 0){
         $("#subEntrada" + llave).text("[*] Este campo es obligatorio.");
         salida = false;
      }else{
         if(llave.localeCompare("Nombre") == 0){
            if(!patronAlfanumerico.test(texto)){
               $("#subEntradaNombre").text("[*] El nombre del producto solo debe contener caracteres alfabéticos.");
               salida = false;
            }else{$("#subEntradaNombre").text("");}
         }else if(llave.localeCompare("Clase") == 0){
            if(!patronAlfanumerico.test(texto)){
               $("#subEntradaClase").text("[*] La clase del producto no debe contener caracteres especiales.");
               salida = false;
            }else{$("#subEntradaClase").text("");}
         }else if(llave.localeCompare("Marca") == 0 && texto.localeCompare("") != 0){
            if(!patronAlfanumerico.test(texto)){
               $("#subEntradaMarca").text("[*] La marca del producto no debe contener caracteres especiales.");
               salida = false;
            }else{$("#subEntradaMarca").text("");}
         }else if(llave.localeCompare("Cantidad") == 0){
            if(!patronNumerico.test(texto)){
               $("#subEntradaCantidad").text("[*] La cantidad del producto debe ser un número.");
               salida = false;
            }else{$("#subEntradaCantidad").text("");}
         }else if(llave.localeCompare("Costo") == 0 && texto.localeCompare("") != 0){
            if(!patronNumerico.test(texto)){
               $("#subEntradaCosto").text("[*] El costo del producto debe ser un número.");
               salida = false;
            }else{$("#subEntradaCosto").text("");}
         }
      }
   }
   return salida;
}
