<?php

  Include '../Inc/header.php';

  foreach ( $objetoretornado as $servicios {}


?>


<section>
                <article>
                    <table>
                    <tr>                         
                    <td>
                    <div class ui = "container">
                    <h2>ACTUALIZACIÓN DE EMPLEADOS</h2>
                        <form action="ServiciosController.php" method="post" enctype="multipart/form-data" class="iu form">
                            <img src ="<?php echo $servicio->Foto_url; ?>" height="100" width="100">  
                            <input type="hidden" name="accion"  id="accion" value="Update">  
                            <label for="Id">Id:</label>
                            <input type="hidden" name="Id" id="Id" value=<?php echo $servicio->Id; ?> />
                            <input type="number" name="Id" id="Id" value=<?php echo $servicio->Id; ?> />
                            <label for="Codigo">Codigo:</label>
                            <input type="text" name="Codigo" id="Codigo" value=<?php echo $servicio->Codigo; ?>/>
                            <label for="Mantenimiento">Mantenimiento:</label>
                            <input type="text" name="Mantenimiento" id="Mantenimiento" value=<?php echo $servicio-Mantenimiento; ?> />
                            <label for="Reparacion">Reparacion:</label>
                            <input type="text" name="Reparacion" id="Reparacion" value=<?php echo $servicio->Reparacion; ?> />
                            <label for="Venta_repuestos">Venta_reparacion:</label>
                            <input type="Venta_repuestos" name="Venta_repuestos" id="Venta_repuestos" value=<?php echo $servicio->Venta_repuestos; ?>/>
                            <label for="Foto">Fotografía:</label>
                            <input type="file" name="Foto" id="Foto" accept=".jpg,.png,.gif" /> <br><br>
                            <button class="ui blue basic button">Guardar Usuario</button>
                    </table>

                </article>
            </section>

 <?php

Include '../Inc/footer.php';

?>