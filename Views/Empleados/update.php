<?php

  Include '../Inc/header.php';

  foreach ( $objetoretornado as $empleados {}


?>


<section>
                <article>
                    <table>
                    <tr>                         
                    <td>
                    <div class ui = "container">
                    <h2>ACTUALIZACIÓN DE EMPLEADOS</h2>
                        <form action="ClientesController.php" method="post" enctype="multipart/form-data" class="iu form">
                            <img src ="<?php echo $empleado->Foto_url; ?>" height="100" width="100">  
                            <input type="hidden" name="accion"  id="accion" value="Update">  
                            <label for="Id">Id:</label>
                            <input type="hidden" name="Id" id="Id" value=<?php echo $empleado->Id; ?> />
                            <input type="number" name="Id" id="Id" value=<?php echo $empleado->Id; ?> />
                            <label for="Nombre">Nombre Completo:</label>
                            <input type="text" name="Nombre" id="Nombre" value=<?php echo $empleado->Nombre; ?>/>
                            <label for="Telefono">Telefono:</label>
                            <input type="num" name="Telefono" id="Telefono" value=<?php echo $empleado->Telefono; ?> />
                            <label for="Sueldo">Sueldo:</label>
                            <input type="text" name="Sueldo" id="Sueldo" value=<?php echo $empleado->Sueldo; ?> />
                            <label for="Cargo">Cargo:</label>
                            <input type="Cargo" name="Cargo" id="Cargo" value=<?php echo $empleado->Cargo; ?>/>
                            <label for="Foto">Fotografía:</label>
                            <input type="file" name="Foto" id="Foto" accept=".jpg,.png,.gif" /> <br><br>
                            <button class="ui blue basic button">Guardar Usuario</button>
                    </table>

                </article>
            </section>

 <?php

Include '../Inc/footer.php';

?>