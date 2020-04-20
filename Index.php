
<?php

/*
Include "Config/Iniciador.php";
$iniciador = new Iniciador();
$iniciador->crearTablas();
$iniciador->llenarTablas();
*/

session_start();

define('ROOTPATH', __DIR__);

?>

<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title>Refigeracion JK</title>
      
      <!-- Own CSS -->
      <!-- <link rel="stylesheet" href="css/estilos.css"/> -->

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
         integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

      <!-- JQuery Script -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   </head>

   <body>

      <?php include("Views/Adiciones/navbar.php"); ?>

      <div class="container">
         <div class="mt-2">
            <div class="row justify-content-center">
               <div class="col-dm-4 justify-content-center">
                  <a href="#"><img src="imagenes/refigeracion.png"/></a>
               </div>
               <div class="col-md-8">
                  <div class="row">
                     <div class="col-md-1 offset-md-4 justify-content-center">
                        <a href="https://www.facebook.com/?stype=lo&jlou=AfcFTvyXq9cSC4jBm02Z50aqt_ME53gOZj9ukry3MS9p3lX_vz5itl16I5dYJp_TB76XodlHCxvRjjPVC69P0XcC&smuh=22358&lh=Ac80_mOIgRZxPaQN"
                           target="_blank">
                           <img style="float: right; margin: 0px 0px 15px 15px;"src="imagenes/facebook.png" alt="Facebook"/>
                        </a>
                     </div>
                     <div class="col-md-1 justify-content-center">
                        <a href="https://twitter.com/?lang=es"target="_blank">
                           <img style="float: right; margin: 0px 0px 15px 15px;"src="imagenes/twiter.png" alt="Twitter"/>
                        </a>
                     </div>
                     <div class="col-md-1 justify-content-center">
                        <a href="https://www.youtube.com/?gl=CO&hl=es-419"target="_blank">
                           <img style="float: right; margin: 0px 0px 15px 15px;"src="imagenes/youtube.png" alt="Youtube"/>
                        </a>
                     </div>
                     <div class="col-md-1 justify-content-center">
                        <a href="https://www.instagram.com/?hl=es-la"target="_blank">
                           <img style="float: right; margin: 0px 0px 15px 15px;"src="imagenes/instagram.png" alt="Instagram"/>
                        </a>
                     </div>
                  </div>
                  <div class="row justify-content-center">
                     <form class="form-inline">
                        <div class="form-group">
                           <input type="text" class="form-control" id="entradaBusqueda">
                           <button class="btn btn-primary ml-2">Buscar</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>

         <!-- 
         <header>
            <nav>
               <li><a href="principal.html">Quines somos</a></li>
               <li><a href="servicios.html">Servicios</a></li>
               <li><a href="frm_contactenos.html">Contactenos</a></li>
               <li><a href="frm_Registro.html"><img src="imagenes/registro.png"></a></li>
               <li><a href="frm_Ingreso.html"><img src="imagenes/login.png"></a></li>
            </nav>
         </header>
          -->
         
         <div id="banner_image">
            <div id="banner_description">
               Lo mejor para su vehiculo
            </div>
         </div>
         
         <section>
               <article>
                  <h1><img src="imagenes/mision.jpg"/>Misión</h1>
                  <p>Nuestra empresa esta dedicada a la venta e instalación de lujos y accesorios para toda clase de vehículos; ademas Somos especialistas en mantenimiento y reparacion de aire acondicionado vehicular. Comprometida en satisfacer las necesidades de sus clientes, ofreciendo productos de alta calidad, trabajando con responsabilidad, eficiencia y creatividad, consolidando una orientación adecuada en los procesos de compra. </p>
                  <h1><img src="imagenes/vision.jpg"/>Visión</h1>
                  <p>Ser una empresa lider a nivel nacional, reconocida por sus altos estandares de calidad en sus servicios, teniendo apertura de nuevas sucursales y amplios establecimientos para brindar mayor comodidad y un mejor servicio a nuestros clientes. </p>
               </article>
               <aside>
                  <h1>Consejos practicos</h1>
                  <iframe width="230" height="150" src="C:\Users\YURANY\Desktop\Nueva carpeta\imagenes\Garaje Consejos para el buen uso del aire acondicionado.mp4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  <p>REALIZA REVICION Y MANTENIMIENTO PERIODICO DE TU AIRE VEHICULAR CONTRIBUYES CON EL MEDIO AMBIENTE, CUIDAS TU  SALUD Y TU VEHICULO EN BUENAS CONDICIONES </p>
               </aside>
         </section>

         <footer>
            <div id="tweet">
               <h1>refigeracion jk</h1>
               <p>Cra. 109 #34-109, Cali, Valle del Cauca</p>
               <p>Tel 4856472 - 3127335675</p>
               <p>refigeracionjk@gmail.com</p>
               <h1>ALIANZAS</h1>
               <th align="center"><img src="imagenes/marcas-chevrolet.png"> </th>
               <th align="center"><img src="imagenes/marcas-hyundai.png"> </th>
               <th align="center"><img src="imagenes/marcas-mazda.png"> </th>
               <th align="center"><img src="imagenes/marcas-kia.png"> </th>
            </div>
         </footer>
      </div>

      <?php include("Views/Adiciones/bootstrapScripts.php"); ?>
      
   </body>
</html>


<!--
<!DOCTYPE html>

<html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width = device-width, initial-scale = 1.0">
      <title>Document</title>
   </head>

   <body>
      <div class="topnav">
         <a id="loginLink" href="Views/Login/Login.php">Iniciar sesión</a>
         <!--
         <a id="registerLink" href="#">Registrarse</a>
         
      </div>
      <h1>Bienvenidos al proyecto ADSI virtual REFIGERACION JK</h1>
      <div class="centrar">
         <img src="Img/refigeracion.png" alt="">
      </div>
   </body>

   <style>
      #loginLink, #registerLink{
         margin-right: 10px;
      }
   </style>

</html>
-->