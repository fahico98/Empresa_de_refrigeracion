
<?php Include '../Inc/header.php'; ?>

<section>
   <article>
      <table>
         <tr>                         
         <td>
         <div class ui = "container">
            <h2>FORMULARIO DE REGISTRO</h2>
            <form action="ClientesController.php" method="post" class="iu form" enctype="multipart/form-data">
               <input type="hidden" name="accion"  id="accion" value="Insert">
               <label for="Documento">Documento:</label>
               <input type="number" name="Documento" id="Documento" />
               <label for="Nombre">Nombre Completo:</label>
               <input type="text" name="Nombre" id="Nombre" />
               <label for="Edad">Edad:</label>
               <input type="num" name="Edad" id="Edad" />
               <label for="Telefono">Telefono:</label>
               <input type="num" name="Telefono" id="Telefono" />
               <label for="Direccion">Dirección:</label>
               <input type="text" name="Direccion" id="Direccion" />
               <label for="Correo">Correo:</label>
               <input type="Correo" name="Correo" id="Correo" />
               <label for="Placa">Placa:</label>
               <input type="num" name="Placa" id="Placa" />
               <label for="Foto">Fotografía:</label>
               <input type="file" name="Foto" id="Foto" accept=".jpg,.png,.gif"/>
               <button class="ui blue basic button">Guardar Usuario</button>
            </form>
         </div>
      </table>
   </article>
   <aside>
      <h1>Consejos practicos</h1>
      <iframe src="C:\Users\YURANY\Desktop\Nueva carpeta\imagenes\Garaje Consejos para el buen uso del aire acondicionado.mp4"
         width="230" height="150" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
         allowfullscreen></iframe>
      <p>
         REALIZA REVICION Y MANTENIMIENTO PERIODICO DE TU AIRE VEHICULAR CONTRIBUYES CON EL MEDIO AMBIENTE, 
         CUIDAS TU  SALUD Y TU VEHICULO EN BUENAS CONDICIONES
      </p>
   </aside>
</section>

<?php Include '../Inc/footer.php'; ?>
