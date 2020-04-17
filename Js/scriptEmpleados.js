

var paginaActual = 1;
var empleadoEnEdicion = null;

var arregloEntradas = {
   "Nombre" : $("#entradaNombre"),
   "Apellido" : $("#entradaApellido"),
   "Documento" : $("#entradaDocumento"),
   "Telefono" : $("#entradaTelefono"),
   "Cargo" : $("#entradaCargo"),
   "Sueldo" : $("#entradaSueldo"),
   "Usuario" : $("#entradaUsuario"),
   "Contrasena" : $("#entradaContrasena"),
   "ReContrasena" : $("#entradaReContrasena")
};

$(document).ready(function(){

   $(".dropdown-item").css("cursor", "pointer");
   $("td").addClass("align-middle mx-0 px-0");
   $("th").addClass("align-middle mx-0 px-0");

   cargarEmpleados("nombre", "", 1);

   $("#formulario").on("submit", function(event){
      event.preventDefault();
      if(validarFormulario()){
         var datosFormulario = new FormData(this);
         if($("#tituloVentanaModal").text() == "Editar empleado"){
            datosFormulario.set("accion", "editar");
            $.ajax({
               type: "POST",
               url: "http://localhost/WampCode/Yurani_Duque/Controllers/EmpleadosController.php",
               data: datosFormulario,
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
               data: datosFormulario,
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
});

function recargarEmpleados(){
   cargarEmpleados(
      $("#dropdownBusqueda").text().toLowerCase(),
      $("#entradaBusqueda").val(),
      paginaActual
   );
}

function cargarEmpleados(parametro, valor, pagina){

   let data = {
      accion: "seleccionar",
      parametro: parametro,
      valor: valor,
      pagina: pagina
   };

   $.ajax({
      type: "GET",
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/EmpleadosController.php",
      data: data,
      dataType: "html",
      success: function(response){
         $("#cuerpoTabla").html(response);
      }, async: false
   });

   data.accion = "paginacion";

   $.ajax({
      type: "GET",
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/EmpleadosController.php",
      data: data,
      dataType: "html",
      success: function(response){
         $("#paginacion").html(response);
      }, async: false
   });

   $("td").addClass("align-middle mx-0 px-0");
   $("th").addClass("align-middle mx-0 px-0");
}

function cargarEmpleadoPorParametro(parametro, valor){
   let salida = null;
   $.ajax({
      type: "GET",
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/EmpleadosController.php",
      data: {valor: valor, accion: "seleccionar_" + parametro},
      dataType: "json",
      async: false,
      success: function(respuesta){
         salida = respuesta != "null" ? respuesta : null;
      }
   });
   return salida;
}

function eliminarEmpleado(id){
   $.ajax({
      type: "GET",
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/EmpleadosController.php",
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
   var patronAlfabetico = /[A-Za-z\s]+$/;
   // var patronAlfanumerico = /[0-9A-Za-z\s]+$/;
   var patronUsuario = /[0-9A-Za-z]+$/;
   var patronContrasena = /[^\s]+$/
   var salida = true;
   for(var [llave, entrada] of Object.entries(arregloEntradas)){
      let texto = entrada.val();
      if(texto.localeCompare("") == 0 && llave.localeCompare("ReContrasena") != 0 && llave.localeCompare("Contrasena") != 0){
         $("#subEntrada" + llave).text("[*] Este campo es obligatorio.");
         salida = false;
      }else{
         if(llave.localeCompare("Nombre") == 0){
            if(!patronAlfabetico.test(texto)){
               $("#subEntradaNombre").text("[*] El nombre del empleado solo debe contener caracteres alfabéticos.");
               salida = false;
            }else{$("#subEntradaNombre").text("");}
         }else if(llave.localeCompare("Apellido") == 0){
            if(!patronAlfabetico.test(texto)){
               $("#subEntradaApellido").text("[*] El apellido del empleado solo debe contener caracteres alfabéticos.");
               salida = false;
            }else{$("#subEntradaApellido").text("");}
         }else if(llave.localeCompare("Documento") == 0){
            if(empleadoEnEdicion != null){
               if(empleadoEnEdicion.documento.localeCompare(texto) != 0 && cargarEmpleadoPorParametro("documento", texto) != null){
                  $("#subEntradaDocumento").text("[*] El documento que ingresó ya existe en la base de datos.");
                  salida = false;
               }else{$("#subEntradaDocumento").text("");}
            }else{
               if(cargarEmpleadoPorParametro("documento", texto) != null){
                  $("#subEntradaDocumento").text("[*] El documento que ingresó ya existe en la base de datos.");
                  salida = false;
               }else{$("#subEntradaDocumento").text("");}
            }
            if(!patronNumerico.test(texto)){
               $("#subEntradaDocumento").text("[*] El documento del empleado solo debe contener caracteres numéricos.");
               salida = false;
            }
         }else if(llave.localeCompare("Telefono") == 0){
            if(!patronNumerico.test(texto)){
               $("#subEntradaTelefono").text("[*] El telefono del empleado solo debe contener caracteres numéricos.");
               salida = false;
            }else{$("#subEntradaTelefono").text("");}
         }else if(llave.localeCompare("Cargo") == 0){
            if(!patronAlfabetico.test(texto)){
               $("#subEntradaCargo").text("[*] El cargo del empleado solo debe contener caracteres alfabéticos.");
               salida = false;
            }else{$("#subEntradaCargo").text("");}
         }else if(llave.localeCompare("Sueldo") == 0){
            if(!patronNumerico.test(texto)){
               $("#subEntradaSueldo").text("[*] El sueldo del empleado solo debe contener caracteres numéricos.");
               salida = false;
            }else{$("#subEntradaSueldo").text("");}
         }else if(llave.localeCompare("Usuario") == 0){
            if(empleadoEnEdicion != null){
               if(empleadoEnEdicion.usuario.localeCompare(texto) != 0 && cargarEmpleadoPorParametro("usuario", texto) != null){
                  $("#subEntradaUsuario").text("[*] El nombre de usuario que ingresó esta siendo usado por otro usuario.");
                  salida = false;
               }else{$("#subEntradaUsuario").text("");}
            }else{
               if(cargarEmpleadoPorParametro("usuario", texto) != null){
                  $("#subEntradaUsuario").text("[*] El nombre de usuario que ingresó esta siendo usado por otro usuario.");
                  salida = false;
               }else{$("#subEntradaUsuario").text("");}
            }
            if(!patronUsuario.test(texto)){
               $("#subEntradaUsuario").text("[*] El nombre de usuario del empleado no debe contener caracteres especiales.");
               salida = false;
            }
         }else if(llave.localeCompare("Contrasena") == 0 && texto.localeCompare("") != 0){
            if(!patronContrasena.test(texto)){
               $("#subEntradaContrasena").text("[*] La contraseña ingresada no es valida.");
               salida = false;
            }else if(texto.localeCompare($("#entradaReContrasena").val()) != 0){
               $("#subEntradaContrasena").text("[*] Las contraseñas no coinciden.");
               salida = false;
            }else{$("#subEntradaContrasena").text("");}
         }else if(llave.localeCompare("ReContrasena") == 0 && texto.localeCompare("") != 0){
            if(!patronContrasena.test(texto)){
               $("#subEntradaReContrasena").text("[*] La contraseña ingresada no es valida.");
               salida = false;
            }else if(texto.localeCompare($("#entradaContrasena").val()) != 0){
               $("#subEntradaReContrasena").text("[*] Las contraseñas no coinciden.");
               salida = false;
            }else{$("#subEntradaReContrasena").text("");}
         }
      }
   }
   return salida;
}
