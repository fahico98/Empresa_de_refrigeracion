<?php
;
include '../Inc/header.php'


?>


<div class= "ui container">
        <h1 align="center">Operaciones con Empleados</h1>
        <div class="ui link cards">
            <?php  foreach ($servicios as $c) {?>
            <div class="card">
                <div class="image">
                <img src="<?php echo $c->Foto_url; ?>" width="200" height="100">
                </div>
                <div class="content">
                <div class="header"><?php echo $c->Nombre; ?></div>
                <div class="description">
                    Codigo: <?php echo $c->Codigo; ?><br>
                    Mantenimiento: <?php echo $c->Mantenimiento; ?><br>
                    Reparacion: <?php echo $c->Reparacion; ?><br>
                    Venta_repuestos: <?php echo $c->Venta_repuestos; ?><br>
                  
                </div>
                </div>
                <div class="extra content">
                <span class="right floated">
                    <a onclick="Delete(<?php echo $c->Id; ?>)"><i class="delete icon"></i></a> 
                    <a onclick="Update(<?php echo $c->Id; ?>)"><i class="edit icon"></i> </a>
                    <i class="eye icon"></i>    
                </span>
               
               
                </div>
                
            </div>
        <script>

                function Delete(id)
                {
                 swal({
                    title: "Seguro que desea borrar?",
                    text: "No prodra recuperar la información borrada",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        swal("Dato borardo", {
                        icon: "success",
                        });
                        location.href="ServiciosController.php?accion=delete&id=" +id;
                    } else {
                        swal("Dato no borrado!");
                    }
                    });

                }

                function Update(id)
                {
                 location.href = "ServiciosController.php?accion=update&id=" +id;
                }
        </script>
            <?php  } ?> 
</div>



<?php


include'../Inc/footer.php';

?>