<?php

  Include '../Inc/header.php';

?>

<section>
                <article>
                    <table>
                    <tr>                         
                    <td>
                    <div class ui = "container">
                    <h2>FORMULARIO DE REGISTRO</h2>
                        <form action="EmpleadosController.php" method="post" class="iu form" enctype="multipart/form-data">
                            <input type="hidden" name="accion"  id="accion" value="Insert">  
                            <label for="Id">Id:</label>
                            <input type="number" name="Id" id="Id" />
                            <label for="Nombre">Nombre Completo:</label>
                            <input type="text" name="Nombre" id="Nombre" />
                            <label for="Apellido">Apellido:</label>
                            <input type="num" name="Apellido" id="Apellido" />
                            <label for="Telefono">Telefono:</label>
                            <input type="num" name="Telefono" id="Telefono" />
                            <label for="Sueldo">Sueldo:</label>
                            <input type="text" name="Sueldo" id="Sueldo" />
                            <label for="Cargo">Cargo:</label>
                            <input type="Cargo" name="Cargo" id="Cargo" />
                            <label for="Foto">Fotografía:</label>
                            <input type="file" name="Foto" id="Foto" accept=".jpg,.png,.gif" /> <br><br>
                            <button class="ui blue basic button">Guardar Usuario</button>
                    </table>

                </article>
                <aside>
                    <h1>Consejos practicos</h1>
                    <iframe width="230" height="150" src="C:\Users\YURANY\Desktop\Nueva carpeta\imagenes\Garaje Consejos para el buen uso del aire acondicionado.mp4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <p>REALIZA REVICION Y MANTENIMIENTO PERIODICO DE TU AIRE VEHICULAR CONTRIBUYES CON EL MEDIO AMBIENTE, CUIDAS TU  SALUD Y TU VEHICULO EN BUENAS CONDICIONES </p>
                </aside>
            </section>

 <?php

Include '../Inc/footer.php';

?>