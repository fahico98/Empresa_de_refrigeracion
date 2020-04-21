
<?php

$cerrarSesionURL = "http://localhost/WampCode/Yurani_Duque/Controllers/LoginController.php?accion=logout";
$inicioURL = "http://localhost/WampCode/Yurani_Duque";
$clientesURL = "http://localhost/WampCode/Yurani_Duque/Views/Clientes";
$empleadosURL = "http://localhost/WampCode/Yurani_Duque/Views/Empleados";
$serviciosURL = "http://localhost/WampCode/Yurani_Duque/Views/Servicios";
$productosURL = "http://localhost/WampCode/Yurani_Duque/Views/Productos";
$registroVehiculosURL = "http://localhost/WampCode/Yurani_Duque/Views/RegistroVehiculos";

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
   <div class="container">
      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">

         <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
               <a class="nav-link active" href="<?php echo($inicioURL); ?>">Inicio</a>
            </li>
            <li class="nav-item">
               <a class="nav-link active" href="#">Servicios</a>
            </li>
            <li class="nav-item">
               <a class="nav-link active" href="#">Contactenos</a>
            </li>
            <li class="nav-item">
               <a class="nav-link active" href="#">Quienes somos</a>
            </li>
         </ul>

         <?php if(isset($_SESSION["usuario"])){ ?>

            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
               <li class="nav-item dropdown active">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                     aria-haspopup="true" aria-expanded="false">
                     <?php echo $_SESSION["nombre"]; ?>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                     <a class="dropdown-item" href="<?php echo($clientesURL); ?>">Clientes</a>
                     <a class="dropdown-item" href="<?php echo($empleadosURL); ?>">Empleados</a>
                     <a class="dropdown-item" href="<?php echo($registroVehiculosURL); ?>">Vehiculos registrados</a>
                     <div class="dropdown-divider"></div>
                     <a class="dropdown-item" href="<?php echo($productosURL); ?>">Productos</a>
                     <a class="dropdown-item" href="<?php echo($serviciosURL); ?>">Servicios</a>
                     <div class="dropdown-divider"></div>
                     <a class="dropdown-item" href="<?php echo($cerrarSesionURL); ?>">Cerrar sesión</a>
                  </div>
               </li>
            </ul>

         <?php }else{ ?>

            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
               <li class="nav-item">
                  <a class="nav-link active" href="#" data-toggle="modal" data-target="#loginModal">
                     Iniciar sesión
                  </a>
               </li>
            </ul>

            <?php include("loginModal.php"); ?>

         <?php } ?>

      </div>
   </div>
</nav>