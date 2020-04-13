
<?php Include '../Inc/header.php'; ?>

<section>
   <article>
      <table>
         <h2>FORMULARIO DE REGISTRO DE USUARIO EN LA PLATAFORMA</h2>
         <form action="LoginController.php" method="post" class="ui form">
            <input type="hidden" name="accion"  id="accion" value="Insert">
            <label for="Username">Nombre de Usuario:</label>
            <input type="text" name="Username" id="Username" placeholder="Escriba su Usuario">
            <label for="Password">Contraseña:</label>
            <input type="password" name="Password" id="Pasword" placeholder="Escriba su Contraseña">
            <button class="ui blue basic button">Guardar Usuario</button>
         </form>
      </table>
   </article>
</section>

<?php Include '../Inc/footer.php'; ?>