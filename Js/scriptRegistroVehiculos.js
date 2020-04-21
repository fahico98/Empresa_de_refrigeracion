
$(document).ready(function(){

   $(".dropdown-item").css("cursor", "pointer");
   $("td").addClass("align-middle mx-0 px-0");
   $("th").addClass("align-middle mx-0 px-0");

   cargarTabla("registro_vehiculos");

   $(".dropdownTablasLink").on("click", function(evento){
      evento.preventDefault();
      $("#dropdownTablas").text($(this).text());
      let tabla = $(this).val().localeCompare("registros") == 0 ? "registro_vehiculos" : "clientes";
      cargarTabla(tabla);
   });
});

function cargarTabla(tabla){
   $.ajax({
      type: "GET",
      url: "http://localhost/WampCode/Yurani_Duque/Controllers/RegistroVehiculosController.php",
      data: {accion: "tabla_" + tabla},
      async: false,
      dataType: "html",
      success: function(response){
         $("#containerTabla").html(response);
      }
   });
}
