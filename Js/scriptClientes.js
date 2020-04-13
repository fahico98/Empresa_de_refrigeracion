
var paginaActual = 1;

var arregloEntradas = {
   "Nombre" : $("#entradaNombre"),
   "Apellido" : $("#entradaApellido"),
   "Documento" : $("#entradaDocumento"),
   "Edad" : $("#entradaEdad"),
   "Telefono" : $("#entradaTelefono"),
   "Direccion" : $("#entradaDireccion"),
   "Email" : $("#entradaEmail"),
   "Placa" : $("#entradaPlaca")
};

$(document).ready(function(){

   $(".dropdown-item").css("cursor", "pointer");
   $("td").addClass("align-middle mx-0 px-0");
   $("th").addClass("align-middle mx-0 px-0");

   cargarClientes("nombre", "", 1);

   $("#formulario").on("submit", function(event){
      event.preventDefault();
      if(validarFormulario()){
         var datosFormulario = new FormData(this);
         if($("#tituloVentanaModal").text() == "Editar cliente"){ç
            datosFormulario.set("accion", "editar");
            $.ajax({
               type: "POST",
               url: "http://localhost/WampCode/Yurani_Duque/Controllers/ClientesController.php",
               data: datosFormulario,
               processData: false,
               contentType: false,
               success: function(){
                  $("#botonCancelar").trigger("click");
                  recargarClientes();
               }, async: false
            });
         }else if($("#tituloVentanaModal").text() == "Registrar nuevo cliente"){
            $.ajax({
               type: "POST",
               url: "http://localhost/WampCode/Yurani_Duque/Controllers/ClientesController.php",
               data: datosFormulario,
               processData: false,
               contentType: false,
               success: function(){
                  $("#botonCancelar").trigger("click");
                  recargarClientes();
               }, async: false
            });
         }
      }
   });

   $("#botonEnviar").on("click", function(evento){
      evento.preventDefault();
      $("#formulario").trigger("submit");
   });

   $(".dropdown-item").on("click", function(evento){
      evento.preventDefault();
      if($(this).text().localeCompare($("#dropdownBusqueda").text()) != 0){
         $("#dropdownBusqueda").text($(this).text());
         $("#entradaBusqueda").val("");
         cargarClientes($(this).text(), "", 1);
      }
   });

   $("#entradaBusqueda").on("keyup", function(evento){
      evento.preventDefault();
      let parametro = $("#dropdownBusqueda").text().toLowerCase();
      let valor = $(this).val();
      cargarClientes(parametro, valor, 1);
   });

   $("#botonVentanaModal").on("click", function(event){
      event.preventDefault();
      reiniciarFormulario();
      $("#tituloVentanaModal").text("Registrar nuevo cliente");
   });

   $(document).on("click", ".botonPagina", function(evento){
      evento.preventDefault();
      let pagina = $(this).attr("id");
      let parametro = $("#dropdownBusqueda").text().toLowerCase();
      let valor = $("#entradaBusqueda").val();
      paginaActual = pagina;
      cargarClientes(parametro, valor, pagina);
   });

   $(document).on("click", ".linkEditar", function(evento){
      evento.preventDefault();
      let cliente = cargarClientePorParametro("id", $(this).attr("id"));
      $("#tituloVentanaModal").text("Editar cliente");
      $("#botonVentanaModal").trigger("click");
      $("#entradaId").val($(this).attr("id"));
      $("#entradaNombre").val(cliente.nombre);
      $("#entradaApellido").val(cliente.apellido);
      $("#entradaDocumento").val(cliente.documento);
      $("#entradaEdad").val(cliente.edad);
      $("#entradaTelefono").val(cliente.telefono);
      $("#entradaDireccion").val(cliente.direccion);
      $("#entradaEmail").val(cliente.email);
      $("#entradaPlaca").val(cliente.placa);
   });

   $(document).on("click", ".linkEliminar", function(event){
      event.preventDefault();
   });

});

function recargarClientes(){
   cargarClientes(
      $("#dropdownBusqueda").text().toLowerCase(),
      $("#entradaBusqueda").val(),
      paginaActual
   );
}

function cargarClientes(parametro, valor, pagina){

   let data = {
      accion: "seleccionar",
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

function cargarClientePorParametro(parametro, valor){
   let salida = null;
   $.ajax({
      type: "GET",
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/ClientesController.php",
      data: {valor: valor, accion: "seleccionar_" + parametro},
      dataType: "json",
      async: false,
      success: function(respuesta){
         salida = respuesta != "null" ? respuesta : null;
      }
   });
   return salida;
}

function reiniciarFormulario(){
   for(var [llave, entrada] of Object.entries(arregloEntradas)){
      $("#subEntrada" + llave).text("");
      entrada.val("");
   }
}

function validarFormulario(){
   var patronNumerico = /[0-9]{1,11}$/;
   var patronAlfabetico = /[A-Za-z\s]+$/;
   var patronAlfanumerico = /[0-9A-Za-z\s]+$/;
   var patronEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
   var salida = true;
   for(var [llave, entrada] of Object.entries(arregloEntradas)){
      let texto = entrada.val();
      if(texto.localeCompare("") == 0){
         $("#subEntrada" + llave).text("[*] Este campo es obligatorio.");
         salida = false;
      }else{
         if(llave.localeCompare("Nombre") == 0){
            if(!patronAlfabetico.test(texto)){
               $("#subEntradaNombre").text("[*] El nombre del cliente solo debe contener caracteres alfabéticos.");
               salida = false;
            }else{$("#subEntradaNombre").text("");}
         }else if(llave.localeCompare("Apellido") == 0){
            if(!patronAlfabetico.test(texto)){
               $("#subEntradaApellido").text("[*] El apellido del cliente solo debe contener caracteres alfabéticos.");
               salida = false;
            }else{$("#subEntradaApellido").text("");}
         }else if(llave.localeCompare("Documento") == 0){
            if(!patronNumerico.test(texto)){
               $("#subEntradaDocumento").text("[*] El documento del cliente solo debe contener caracteres numéricos.");
               salida = false;
            }else if(cargarClientePorParametro("documento", texto) != null){
               $("#subEntradaDocumento").text("[*] El documento que ingresó ya existe en la base de datos.");
               salida = false;
            }else{$("#subEntradaDocumento").text("");}
         }else if(llave.localeCompare("Edad") == 0){
            let numVal = parseInt(texto, 10);
            if(!patronNumerico.test(texto)){
               $("#subEntradaEdad").text("[*] La edad del cliente solo debe contener caracteres numéricos.");
               salida = false;
            }else{
               if(numVal < 18 || numVal > 99){
                  $("#subEntradaEdad").text("[*] La edad del cliente no esta en el rango permitido (18 a 99 años).");
                  salida = false;
               }else{$("#subEntradaEdad").text("");}
            }
         }else if(llave.localeCompare("Telefono") == 0){
            if(!patronNumerico.test(texto)){
               $("#subEntradaTelefono").text("[*] El telefono del cliente solo debe contener caracteres numéricos.");
               salida = false;
            }else{$("#subEntradaTelefono").text("");}
         }else if(llave.localeCompare("Direccion") == 0){
            if(!patronAlfanumerico.test(texto)){
               $("#subEntradaDireccion").text("[*] La dirección del cliente no debe contener caracteres especiales.");
               salida = false;
            }else{$("#subEntradaDireccion").text("");}
         }else if(llave.localeCompare("Email") == 0){
            if(!patronEmail.test(texto)){
               $("#subEntradaEmail").text("[*] No corresponde con una dirección de correo electrónico.");
               salida = false;
            }else if(cargarClientePorParametro("email", texto) != null){
               $("#subEntradaEmail").text("[*] El email que ingresó ya esta siendo usado por otro cliente.");
               salida = false;
            }else{$("#subEntradaEmail").text("");}
         }else if(llave.localeCompare("Placa") == 0){
            if(!patronAlfanumerico.test(texto)){
               $("#subEntradaPlaca").text("[*] La placa no debe contener caracteres especiales.");
               salida = false;
            }else if(cargarClientePorParametro("placa", texto) != null){
               $("#subEntradaPlaca").text("[*] La placa que ingresó le pertenece a otro cliente.");
               salida = false;
            }else{$("#subEntradaPlaca").text("");}
         }
      }
   }
   return salida;
}
