
<!-- Login modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="tituloLoginModal" aria-hidden="true">
   <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
         <div class="modal-header card-header bg-primary">
            <h5 class="modal-title text-white" id="tituloLoginModal">Inicio de sesión para empleados</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="Controllers/LoginController.php" method="POST" id="formularioLogin">
            <div class="modal-body">
               <div class="container my-4">
                  <div class="form-group row">
                     <label for="usuarioLogin" class="col-sm-3 col-form-label justify-content-end">Usuario</label>
                     <div class="col-sm-9">
                        <input type="text" class="form-control" id="usuarioLogin" name="usuarioLogin">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="contrasenaLogin" class="col-sm-3 col-form-label justify-content-end">Contraseña</label>
                     <div class="col-sm-9">
                        <input type="password" class="form-control" id="contrasenaLogin" name="contrasenaLogin">
                     </div>
                  </div>
                  <input type="hidden" name="accion" value="login">
                  <div class="mt-4">
                     <small style="color: red;" id="textoNota">
                        <!-- warning text... -->
                     </small>
                  </div>            
                  <div class="mt-4">
                     <small>
                        Recuerde que si no esta registrado no podrá ingresar al sistema. Si desea registrase
                        debe solicitar el registro de su cuenta ante el gerente de la empresa o con alguien 
                        que este autorizado para hacerlo.
                     </small>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary">Iniciar sesión</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
         </form>
      </div>
   </div>
</div>

<!-- Own script -->
<script type="text/javascript" src="http://localhost/WampCode/Yurani_Duque/Js/login.js"></script>
