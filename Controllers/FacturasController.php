<?php
   
include '../Models/Factura.php';

class FacturasController extends Factura{

   public function tablaFacturas(){
      return file_get_contents("../Views/ComprasCliente/tablaFacturas.php");
   }

   public function tablaProductos(){
      return file_get_contents("../Views/ComprasCliente/tablaProductos.php");
   }

   public function tablaServicios(){
      return file_get_contents("../Views/ComprasCliente/tablaServicios.php");
   }

   public function seleccionar($cliente_id, $parametro, $valor, $pagina){
      return $this->seleccionarFacturas($cliente_id, $parametro, $valor, $pagina);
   }

   public function insertar($cliente_id, $costo){
      $this->cliente_id = $cliente_id;
      $this->costo = $costo;
      return $this->insertarFactura();
   }

   public function seleccionarPorId($id){
      return $this->seleccionarFacturaPorId($id);
   }

   public function seleccionarPorFecha($cliente_id, $fecha_hora){
      return $this->seleccionarPorParametro($cliente_id, "fecha_hora", $fecha_hora);
   }

   public function eliminar($id){
      $this->eliminarFactura($id);
   }

   public function plantillaFacturas($factuas){
      $salida = "";
      if(count($factuas) !== 0){
         foreach($factuas as $factura){
            $salida .= 
               "<tr class='text-center'>
                  <th scope='row'>" . str_pad($factura->id, 6, "0", STR_PAD_LEFT) . "</th>
                  <td>$factura->fecha_hora</td>
                  <td>$factura->costo_factura</td>
                  <td class='celdaDeAccion'>
                     <a href='http://localhost/WampCode/Yurani_Duque/facturaPDF.php?id=$factura->id'
                        class='text-primary linkDescargar'><small>descargar</small></a>
                     &nbsp;&nbsp;
                     <a href='#' class='text-danger linkEliminar' id='$factura->id'><small>eliminar</small></a>
                  </td>
               </tr>";
         }
      }else{
         $salida =
            "<tr><td colspan='9' class='text-center'>
               <h4>No hay facturas para mostrar...</h4>
            </td></tr>";
      }
      return $salida;
   }

   public function plantillaPaginacion($cliente_id, $parametro, $valor, $pagina){
      $salida = "";
      $totalPaginas = $this->totalPaginas($cliente_id, $parametro, $valor);
      for($i = 1 ; $i <= $totalPaginas; $i++){
         if($i == $pagina){
            $salida .= "<button type='button' class='btn btn-primary btn-sm ml-1 botonPagina' id='$i' disabled>$i</button>";
         }else{
            $salida .= "<button type='button' class='btn btn-primary btn-sm ml-1 botonPagina' id='$i'>$i</button>";
         }
      }
      return $salida;
   }
}

if(isset($_GET['accion'])){
   if($_GET['accion'] == "tabla_facturas"){
      $factCont = new FacturasController();
      echo $factCont->tablaFacturas();
   }
}

if(isset($_GET['accion'])){
   if($_GET['accion'] == "tabla_productos"){
      $factCont = new FacturasController();
      echo $factCont->tablaProductos();
   }
}

if(isset($_GET['accion'])){
   if($_GET['accion'] == "tabla_servicios"){
      $factCont = new FacturasController();
      echo $factCont->tablaServicios();
   }
}

if(isset($_GET['accion'])){
   if($_GET['accion'] == "seleccionar_id"){
      $factCont = new FacturasController();
      echo $factCont->seleccionarPorId($_GET["id"]);
   }
}

if(isset($_GET['accion'])){
   if($_GET['accion'] == "seleccionar"){
      $factCont = new FacturasController();
      echo $factCont->plantillaFacturas(
         $factCont->seleccionar(
            $_GET["cliente_id"],
            $_GET["parametro"],
            $_GET["valor"],
            $_GET["pagina"]
         )
      );
   }
}

if(isset($_GET["accion"])){
   if($_GET['accion'] == "insertar"){
      $factCont = new FacturasController();
      echo $factCont->insertar($_GET["cliente_id"], $_GET["costo"]);
   }
}

if(isset($_GET["accion"])){
   if($_GET["accion"] == "eliminar"){
      $factCont = new FacturasController();
      $factCont->eliminar($_GET["id"]);
   }
}

if(isset($_GET["accion"])){
   if($_GET["accion"] == "paginacion"){
      $factCont = new FacturasController();
      echo $factCont->plantillaPaginacion(
         $_GET["cliente_id"],
         $_GET["parametro"],
         $_GET["valor"],
         $_GET["pagina"]
      );
   }
}
