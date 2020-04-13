
$(document).ready(function(){

   $("#formularioLogin").submit(function(event){
      if($("#usuarioLogin").val() == "" || $("#contrasenaLogin").val() == ""){
         $("#textoNota").html("Ninguno de los campos debe estar vacío...!");
         event.preventDefault();
      }else if(!verificarDatos(new FormData(this))){
         $("#textoNota").html("El nombre de usuario o la contraseña son incorrectos...!");
         event.preventDefault();
      }else{
         $("#textoNota").html("");
      }
   });
});

function verificarDatos(datosFormulario){
   datosFormulario.append("ajax", true);
   var salida = false;
   $.ajax({
      type: "POST",
      url: "Controllers/LoginController.php",
      data: datosFormulario,
      contentType: false,
      cache: false,
      processData: false,
      success: function(respuesta){

         salida = respuesta.localeCompare("credenciales_validas") == 0;
      }, async: false
   });
   return salida;
}

