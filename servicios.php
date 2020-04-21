
<?php session_start(); ?>

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
               <div class="col-md-4 offset-md-4">
                  <div class="row">
                     <div class="col-md-2 offset-md-2 justify-content-center">
                        <a href="https://www.facebook.com/?stype=lo&jlou=AfcFTvyXq9cSC4jBm02Z50aqt_ME53gOZj9ukry3MS9p3lX_vz5itl16I5dYJp_TB76XodlHCxvRjjPVC69P0XcC&smuh=22358&lh=Ac80_mOIgRZxPaQN"
                           target="_blank">
                           <img style="float: right; margin: 0px 0px 15px 15px;"src="imagenes/facebook.png" alt="Facebook"/>
                        </a>
                     </div>
                     <div class="col-md-2 justify-content-center">
                        <a href="https://twitter.com/?lang=es"target="_blank">
                           <img style="float: right; margin: 0px 0px 15px 15px;"src="imagenes/twiter.png" alt="Twitter"/>
                        </a>
                     </div>
                     <div class="col-md-2 justify-content-center">
                        <a href="https://www.youtube.com/?gl=CO&hl=es-419"target="_blank">
                           <img style="float: right; margin: 0px 0px 15px 15px;"src="imagenes/youtube.png" alt="Youtube"/>
                        </a>
                     </div>
                     <div class="col-md-2 justify-content-center">
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

         <div class="card border-primary my-4 w-100">
            <div class="card-header bg-primary">
               <h3 class="text-white">Lo mejor para su vehiculo</h3>
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-sm-6">
                     <h4><img src="imagenes/mision.jpg"/>Misión</h4>
                     <p>Nuestra empresa esta dedicada a la venta e instalación de lujos y accesorios para toda clase de vehículos; ademas Somos especialistas en mantenimiento y reparacion de aire acondicionado vehicular. Comprometida en satisfacer las necesidades de sus clientes, ofreciendo productos de alta calidad, trabajando con responsabilidad, eficiencia y creatividad, consolidando una orientación adecuada en los procesos de compra. </p>
                  </div>
                  <div class="col-sm-6">
                     <h4><img src="imagenes/vision.jpg"/>Visión</h4>
                     <p>Ser una empresa lider a nivel nacional, reconocida por sus altos estandares de calidad en sus servicios, teniendo apertura de nuevas sucursales y amplios establecimientos para brindar mayor comodidad y un mejor servicio a nuestros clientes. </p>
                  </div>
               </div>
            </div>
         </div>

         <div class="card border-primary my-4 w-100">
            <div class="card-header bg-primary">
               <h3 class="text-white">Servicios empresariales</h3>
            </div>
            <div class="card-body">
               <table border="0" align="center">
                  <tr valign="bottom" align="center">
                     <th><h4>refigeracion y aire acondicionado</h4></th>
                     <th><h4>repuestos</h4></th>
                  </tr>
                  <tr>
                     <th align="center"><img src="imagenes/aire acondicionado.jpg"></th>
                     <td align="center"><img src="imagenes/repuestos.jpg"></td>
                  </tr>
                  <tr>
                     <td align="center"><P> el mantenimiento de aires acondicionados y refigeracion de su vehiculo merece un experto, gracias a nuestro equipo de trabajo y tecnología podemos garantizar un resultado que cumple con los más altos estándares de calidad.</P></td> </p></td>
                     <td align="center"><p>Ofrecemos amplia gama de repuestos y equipos de aire acondicionado automotriz tanto alternativos como originales para cualquier tipo de vehículo. Somos importadores directos. </p></td>
                  </tr>
               </table>
            </div>
         </div>

         <div class="card border-primary my-4 w-100">
            <div class="card-header bg-primary">
               <h3 class="text-white">Refigeracion JK</h3>
            </div>
            <div class="card-body">
               <div class="row justify-content-center">
                  <h4>Cra. 109 #34-109, Cali, Valle del Cauca</h4>
               </div>
               <div class="row justify-content-center">
                  <h4>refigeracionjk@gmail.com</h4>
               </div>
               <div class="row justify-content-center my-3">
                  <h5>ALIANZAS</h5>
               </div>
               <div class="row justify-content-center">
                  <th align="center"><img src="imagenes/marcas-chevrolet.png"> </th>
               </div>
               <div class="row justify-content-center">
                  <th align="center"><img src="imagenes/marcas-hyundai.png"> </th>
               </div>
               <div class="row justify-content-center">
                  <th align="center"><img src="imagenes/marcas-mazda.png"> </th>
               </div>
               <div class="row justify-content-center">
                  <th align="center"><img src="imagenes/marcas-kia.png"> </th>
               </div>
            </div>
         </div>
      </div>

      <?php include("Views/Adiciones/bootstrapScripts.php"); ?>
      
   </body>

</html>
