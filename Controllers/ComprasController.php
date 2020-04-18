<?php
   
include '../Models/Compra.php';

class ComprasController extends Compra{

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







   public function seleccionarTodas($cliente_id){
      return $this->seleccionarPorParametro($cliente_id);
   }

   public function seleccionarPorId($cliente_id, $id){
      return $this->seleccionarPorParametro($cliente_id, "id", $id);
   }

   public function seleccionarPorFecha($cliente_id, $fecha_hora){
      return $this->seleccionarPorParametro($cliente_id, "fecha_hora", $fecha_hora);
   }

   /*
   public function seleccionarPorNombre($nombre){
      return $this->seleccionarPorParametro("nombre", $nombre);
   }

   public function seleccionarPorTipo($tipo){
      return $this->seleccionarPorParametro("tipo", $tipo);
   }
   */

   
   public function insertar($nombre, $tipo, $costo, $observaciones){
      $this->nombre = $nombre;
      $this->tipo = $tipo;
      $this->costo = $costo;
      $this->observaciones = $observaciones;
      $this->guardarServicio();
   }

   public function editar($id, $nombre, $tipo, $costo, $observaciones){
      $this->nombre = $nombre;
      $this->tipo = $tipo;
      $this->costo = $costo;
      $this->observaciones = $observaciones;
      $this->actualizarServicio($id);
   }

   public function eliminar($id){
      $this->eliminarServicio($id);
   }

   public function plantillaFacturas($factuas){
      $salida = "";
      if(count($factuas) !== 0){
         foreach($factuas as $factura){
            $salida .= 
               "<tr class='text-center'>
                  <th scope='row'>" . str_pad($factura->id, 6, "0", STR_PAD_LEFT) . "</th>
                  <td>" . $factura->fecha_hora .         "</td>
                  <td>" . $factura->costo .              "</td>
                  <td class='celdaDeAccion'>
                     <a href='#' class='text-danger linkEliminar' id='" . $factura->id . "'><small>Eliminar</small></a>
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
      $compCont = new ComprasController();
      echo $compCont->tablaFacturas();
   }
}

if(isset($_GET['accion'])){
   if($_GET['accion'] == "tabla_productos"){
      $compCont = new ComprasController();
      echo $compCont->tablaProductos();
   }
}

if(isset($_GET['accion'])){
   if($_GET['accion'] == "tabla_servicios"){
      $compCont = new ComprasController();
      echo $compCont->tablaServicios();
   }
}






/*
if(isset($_GET["accion"])){
   if($_GET["accion"] == "seleccionar"){
      $servCont = new ServiciosController();
      $salida = $servCont->seleccionarPorId($_GET['cliente_id']);
      echo $salida == null ? "null" : $salida;
   }
}

if(isset($_GET["accion"])){
   if($_GET["accion"] == "seleccionar_id"){
      $servCont = new ServiciosController();
      $salida = $servCont->seleccionarPorId($_GET['cliente_id'], $_GET["valor"]);
      echo $salida == null ? "null" : $salida;
   }
}

if(isset($_GET["accion"])){
   if($_GET["accion"] == "seleccionar_fecha_hora"){
      $servCont = new ServiciosController();
      $salida = $servCont->seleccionarPorFecha($_GET["cliente_id"], $_GET["valor"]);
      echo $salida == null ? "null" : $salida;
   }
}

if(isset($_POST['accion'])){
   if($_POST['accion'] == "insertar"){
      $servCont = new ServiciosController();
      $servCont->insertar(
         $_POST['nombre'],
         $_POST['tipo'],
         $_POST['costo'],
         $_POST['observaciones']
      );
   }
}

if(isset($_POST["accion"])){
   if($_POST["accion"] == "editar"){
      $servCont = new ServiciosController();
      $servCont->editar(
         $_POST['id'],
         $_POST['nombre'],
         $_POST['tipo'],
         $_POST['costo'],
         $_POST['observaciones']
      );
   }
}

if(isset($_GET['accion'])){
   if($_GET['accion'] == "seleccionar"){
      $servCont = new ServiciosController();
      echo $servCont->plantillaServicios(
         $servCont->seleccionar(
            $_GET["parametro"],
            $_GET["valor"],
            $_GET["pagina"]
         )
      );
   }
}
*/

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
