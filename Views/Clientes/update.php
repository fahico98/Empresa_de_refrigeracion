<?php

  Include '../Inc/header.php';

  foreach ( $objetoretornado as $cliente) {}


?>


<section>
                <article>
                    <table>
                    <tr>                         
                    <td>
                    <div class ui = "container">
                    <h2>ACTUALIZACIÓN DE EMPLEADOS</h2>
                        <form action="ClientesController.php" method="post" enctype="multipart/form-data" class="iu form">
                            <img src ="<?php echo $cliente->Foto_url; ?>" height="100" width="100">  
                            <input type="hidden" name="accion"  id="accion" value="Update">  
                            <label for="Documento">Documento:</label>
                            <input type="hidden" name="Id" id="Id" value=<?php echo $cliente->Id; ?> />
                            <input type="number" name="Documento" id="Documento" value=<?php echo $cliente->Documento; ?> />
                            <label for="Nombre">Nombre Completo:</label>
                            <input type="text" name="Nombre" id="Nombre" value=<?php echo $cliente->Nombre; ?>/>
                            <label for="Edad">Edad:</label>
                            <input type="num" name="Edad" id="Edad" value=<?php echo $cliente->Edad; ?>/>
                            <label for="Telefono">Telefono:</label>
                            <input type="num" name="Telefono" id="Telefono" value=<?php echo $cliente->Telefono; ?> />
                            <label for="Direccion">Dirección:</label>
                            <input type="text" name="Direccion" id="Direccion" value=<?php echo $cliente->Direccion; ?> />
                            <label for="Correo">Correo:</label>
                            <input type="Correo" name="Correo" id="Correo" value=<?php echo $cliente->Correo; ?>/>
                            <label for="Placa">Placa:</label>
                            <input type="num" name="Placa" id="Placa" value=<?php echo $cliente->Edad; ?>/>
                            <label for="Foto">Fotografía:</label>
                            <input type="file" name="Foto" id="Foto" accept=".jpg,.png,.gif" /> <br><br>
                            <button class="ui blue basic button">Guardar Usuario</button>
                    </table>

                </article>
            </section>

 <?php

Include '../Inc/footer.php';

?>