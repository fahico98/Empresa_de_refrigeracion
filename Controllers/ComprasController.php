<?php
   
include '../Models/Compra.php';

class ComprasController extends Compra{

   public function insertarProducto($producto_id, $empleado_id, $factura_id, $cantidad, $costo_compra){
      $this->servicio_id = null;
      $this->producto_id = $producto_id;
      $this->empleado_id = $empleado_id;
      $this->factura_id = $factura_id;
      $this->cantidad = $cantidad;
      $this->costo_compra = $costo_compra;
      $this->insertarCompraProducto();
   }

   public function insertarServicio($servicio_id, $empleado_id, $factura_id, $cantidad, $costo_compra){
      $this->producto_id = null;
      $this->servicio_id = $servicio_id;
      $this->empleado_id = $empleado_id;
      $this->factura_id = $factura_id;
      $this->cantidad = $cantidad;
      $this->costo_compra = $costo_compra;
      $this->insertarCompraServicio();
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
   if($_GET['accion'] == "insertar"){
      $compCont = new ComprasController();
      if(isset($_GET["producto_id"])){
         $compCont->insertarProducto(
            $_GET['producto_id'],
            $_GET['empleado_id'],
            $_GET['factura_id'],
            $_GET['cantidad'],
            $_GET['costoTotal']
         );
      }else{
         $compCont->insertarServicio(
            $_GET['servicio_id'],
            $_GET['empleado_id'],
            $_GET['factura_id'],
            $_GET['cantidad'],
            $_GET['costoTotal']
         );
      }
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
